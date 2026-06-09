<?php

namespace Tests\Feature;

use App\Enums\ApplicationStatus;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\ApplicationA1Course;
use App\Models\Assessment;
use App\Models\AssessmentCourseMapping;
use App\Models\Assessor;
use App\Models\Committee;
use App\Models\Course;
use App\Models\StaffRpl;
use App\Models\StudyProgram;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\DataProvider;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleApiAccessTest extends TestCase
{
    use RefreshDatabase;

    private int $userSequence = 1;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_unauthenticated_api_requests_are_rejected(): void
    {
        $this->getJson('/api/auth/me')->assertUnauthorized();
        $this->getJson('/api/study-programs')->assertUnauthorized();
        $this->getJson('/api/admin/users')->assertUnauthorized();
        $this->getJson('/api/applicant/applications')->assertUnauthorized();
        $this->getJson('/api/staff/submissions')->assertUnauthorized();
        $this->getJson('/api/assessor/assessments')->assertUnauthorized();
        $this->getJson('/api/committee/applications')->assertUnauthorized();
    }

    public function test_authenticated_roles_can_read_shared_study_programs(): void
    {
        $this->studyProgram();

        foreach (['applicant', 'staff_rpl', 'assessor', 'committee', 'system_admin'] as $role) {
            Sanctum::actingAs($this->userWithRole($role));

            $this->getJson('/api/study-programs')
                ->assertOk()
                ->assertJsonPath('success', true);
        }
    }

    #[DataProvider('roleEndpointMatrix')]
    public function test_role_protected_api_groups_reject_other_roles(string $allowedRole, string $endpoint): void
    {
        foreach (['applicant', 'staff_rpl', 'assessor', 'committee', 'system_admin'] as $role) {
            if ($role === $allowedRole) {
                continue;
            }

            Sanctum::actingAs($this->userWithRole($role));

            $this->getJson($endpoint)->assertForbidden();
        }
    }

    public function test_admin_can_read_management_resources(): void
    {
        $admin = $this->userWithRole('system_admin');
        $studyProgram = $this->studyProgram();
        $course = $this->course();
        $managedUser = $this->userWithRole('committee');

        Sanctum::actingAs($admin);

        $this->getJson('/api/admin/study-programs')->assertOk()->assertJsonPath('success', true);
        $this->getJson("/api/admin/study-programs/{$studyProgram->id}")->assertOk()->assertJsonPath('success', true);
        $this->getJson('/api/admin/courses')->assertOk()->assertJsonPath('success', true);
        $this->getJson("/api/admin/courses/{$course->id}")->assertOk()->assertJsonPath('success', true);
        $this->getJson('/api/admin/users')->assertOk()->assertJsonPath('success', true);
        $this->getJson("/api/admin/users/{$managedUser->id}")->assertOk()->assertJsonPath('success', true);
    }

    public function test_applicant_can_manage_profile_application_a1_and_a2_resources(): void
    {
        $applicantUser = $this->userWithRole('applicant');
        $applicant = $this->applicantFor($applicantUser);
        $studyProgram = $this->studyProgram();

        Sanctum::actingAs($applicantUser);

        $this->getJson('/api/applicant/profile')->assertOk()->assertJsonPath('success', true);

        $applicationId = $this->postJson('/api/applicant/applications', [
            'study_program_id' => $studyProgram->id,
            'rpl_type' => 'hybrid',
        ])
            ->assertCreated()
            ->assertJsonPath('success', true)
            ->json('data.id');

        $this->getJson('/api/applicant/applications')->assertOk()->assertJsonPath('success', true);
        $this->getJson("/api/applicant/applications/{$applicationId}")->assertOk()->assertJsonPath('success', true);

        $a1CourseId = $this->postJson("/api/applicant/applications/{$applicationId}/a1-courses", [
            'course_code' => 'A1-101',
            'course_name' => 'Algoritma Dasar',
            'credits' => 3,
            'grade' => 'A',
            'institution_name' => 'Universitas Asal',
        ])
            ->assertCreated()
            ->json('data.id');

        $this->getJson("/api/applicant/applications/{$applicationId}/a1-courses")->assertOk()->assertJsonPath('success', true);
        $this->getJson("/api/applicant/applications/{$applicationId}/a1-courses/{$a1CourseId}")->assertOk()->assertJsonPath('success', true);

        $a2ExperienceId = $this->postJson("/api/applicant/applications/{$applicationId}/a2-learning-experiences", [
            'title' => 'Backend Developer',
            'experience_type' => 'work',
            'organization_name' => 'PT Contoh',
            'start_date' => '2024-01-01',
            'end_date' => '2025-01-01',
            'is_ongoing' => false,
            'description' => 'Membangun API internal.',
        ])
            ->assertCreated()
            ->json('data.id');

        $this->getJson("/api/applicant/applications/{$applicationId}/a2-learning-experiences")->assertOk()->assertJsonPath('success', true);
        $this->getJson("/api/applicant/applications/{$applicationId}/a2-learning-experiences/{$a2ExperienceId}")->assertOk()->assertJsonPath('success', true);

        $this->assertDatabaseHas('applications', [
            'id' => $applicationId,
            'applicant_id' => $applicant->id,
            'status' => ApplicationStatus::DRAFT,
        ]);
    }

    public function test_staff_can_review_return_and_assign_submissions(): void
    {
        $staff = $this->userWithRole('staff_rpl');
        $assessorUser = $this->userWithRole('assessor');
        $this->assessorFor($assessorUser);

        $submittedApplication = $this->application(['status' => ApplicationStatus::SUBMITTED]);
        $underReviewApplication = $this->application(['status' => ApplicationStatus::UNDER_REVIEW]);
        $assignableApplication = $this->application(['status' => ApplicationStatus::UNDER_REVIEW]);

        Sanctum::actingAs($staff);

        $this->getJson('/api/staff/assessors')->assertOk()->assertJsonPath('success', true);
        $this->getJson('/api/staff/submissions')->assertOk()->assertJsonPath('success', true);
        $this->getJson("/api/staff/submissions/{$submittedApplication->id}")->assertOk()->assertJsonPath('success', true);

        $this->patchJson("/api/staff/submissions/{$submittedApplication->id}/review")
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->patchJson("/api/staff/submissions/{$underReviewApplication->id}/return", [
            'review_notes' => 'Lengkapi dokumen pendukung.',
        ])
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->patchJson("/api/staff/submissions/{$assignableApplication->id}/assign-assessor", [
            'assessor_id' => $assessorUser->id,
        ])
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->assertDatabaseHas('applications', [
            'id' => $assignableApplication->id,
            'assigned_assessor_id' => $assessorUser->id,
            'status' => ApplicationStatus::UNDER_ASSESSMENT,
        ]);
    }

    public function test_assessor_can_assess_map_and_submit_assigned_application(): void
    {
        $assessorUser = $this->userWithRole('assessor');
        $assessor = $this->assessorFor($assessorUser);
        $course = $this->course();
        $application = $this->application([
            'assigned_assessor_id' => $assessorUser->id,
            'status' => ApplicationStatus::UNDER_ASSESSMENT,
        ]);
        $a1Course = ApplicationA1Course::create([
            'application_id' => $application->id,
            'course_code' => 'EXT-101',
            'course_name' => 'Pemrograman Web',
            'credits' => 3,
            'grade' => 'A',
            'institution_name' => 'Universitas Asal',
        ]);

        Sanctum::actingAs($assessorUser);

        $this->getJson('/api/assessor/assessments')->assertOk()->assertJsonPath('success', true);
        $this->getJson("/api/assessor/assessments/{$application->id}")->assertOk()->assertJsonPath('success', true);

        $assessmentId = $this->postJson("/api/assessor/assessments/{$application->id}", [
            'notes' => 'Layak dinilai.',
        ])
            ->assertCreated()
            ->assertJsonPath('success', true)
            ->json('data.id');

        $mappingId = $this->postJson("/api/assessor/assessments/{$assessmentId}/mappings", [
            'application_a1_course_id' => $a1Course->id,
            'course_id' => $course->id,
            'is_recognized' => true,
            'notes' => 'Setara.',
        ])
            ->assertCreated()
            ->assertJsonPath('success', true)
            ->json('data.id');

        $this->getJson("/api/assessor/assessments/{$assessmentId}/mappings")->assertOk()->assertJsonPath('success', true);

        $this->putJson("/api/assessor/assessments/mappings/{$mappingId}", [
            'course_id' => $course->id,
            'is_recognized' => true,
            'notes' => 'Setara penuh.',
        ])
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->postJson("/api/assessor/assessments/{$assessmentId}/submit")
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->assertDatabaseHas('assessments', [
            'id' => $assessmentId,
            'assessor_id' => $assessor->id,
            'recommendation' => 'pass',
        ]);
        $this->assertDatabaseHas('applications', [
            'id' => $application->id,
            'status' => ApplicationStatus::ASSESSED,
        ]);
    }

    public function test_committee_can_review_and_approve_assessed_applications(): void
    {
        $committee = $this->userWithRole('committee');
        $assessedApplication = $this->assessedApplication();
        $approvedApplication = $this->assessedApplication(['status' => ApplicationStatus::APPROVED]);

        Sanctum::actingAs($committee);

        $this->getJson('/api/committee/applications')->assertOk()->assertJsonPath('success', true);
        $this->getJson("/api/committee/applications/{$assessedApplication->id}")->assertOk()->assertJsonPath('success', true);

        $this->patchJson("/api/committee/applications/{$assessedApplication->id}/approve")
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->getJson('/api/committee/applications/approved')->assertOk()->assertJsonPath('success', true);
        $this->getJson("/api/committee/applications/approved/{$approvedApplication->id}")->assertOk()->assertJsonPath('success', true);

        $this->assertDatabaseHas('applications', [
            'id' => $assessedApplication->id,
            'status' => ApplicationStatus::APPROVED,
        ]);
    }

    public static function roleEndpointMatrix(): array
    {
        return [
            'admin users' => ['system_admin', '/api/admin/users'],
            'admin study programs' => ['system_admin', '/api/admin/study-programs'],
            'admin courses' => ['system_admin', '/api/admin/courses'],
            'applicant profile' => ['applicant', '/api/applicant/profile'],
            'applicant applications' => ['applicant', '/api/applicant/applications'],
            'staff assessors' => ['staff_rpl', '/api/staff/assessors'],
            'staff submissions' => ['staff_rpl', '/api/staff/submissions'],
            'assessor assessments' => ['assessor', '/api/assessor/assessments'],
            'committee applications' => ['committee', '/api/committee/applications'],
            'committee approved applications' => ['committee', '/api/committee/applications/approved'],
        ];
    }

    private function userWithRole(string $role): User
    {
        Role::findOrCreate($role, 'web');

        $user = User::factory()->create([
            'name' => str_replace('_', ' ', ucfirst($role)) . ' ' . $this->userSequence,
            'email' => $role . $this->userSequence++ . '@grpl.test',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $user->assignRole($role);

        return $user;
    }

    private function applicantFor(User $user): Applicant
    {
        return Applicant::create([
            'user_id' => $user->id,
            'nik' => '317400000000' . str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
            'phone' => '08120000' . str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
            'address' => 'Alamat test',
            'birth_place' => 'Jakarta',
            'birth_date' => '2000-01-01',
            'gender' => 'male',
            'marital_status' => 'single',
            'nationality' => 'Indonesia',
            'postal_code' => '12345',
            'last_education' => 'SMA',
            'institution_name' => 'Sekolah Test',
            'study_program' => 'IPA',
            'graduation_year' => 2020,
        ]);
    }

    private function assessorFor(User $user): Assessor
    {
        return Assessor::create([
            'user_id' => $user->id,
            'nip' => '1980000000' . str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
            'phone' => '08130000' . str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
            'address' => 'Alamat asesor',
        ]);
    }

    private function staffFor(User $user): StaffRpl
    {
        return StaffRpl::create([
            'user_id' => $user->id,
            'nip' => '1970000000' . str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
            'phone' => '08140000' . str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
        ]);
    }

    private function committeeFor(User $user): Committee
    {
        return Committee::create([
            'user_id' => $user->id,
            'nip' => '1960000000' . str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
            'phone' => '08150000' . str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
        ]);
    }

    private function studyProgram(array $overrides = []): StudyProgram
    {
        return StudyProgram::create(array_merge([
            'code' => 'IF' . str_pad((string) ($this->userSequence++), 3, '0', STR_PAD_LEFT),
            'name' => 'Informatika Test',
            'total_sks' => 144,
            'max_convertible_sks' => 100,
            'supports_a1' => true,
            'supports_a2' => true,
            'is_hybrid_allowed' => true,
            'status' => 'active',
        ], $overrides));
    }

    private function course(array $overrides = []): Course
    {
        return Course::create(array_merge([
            'code' => 'MK' . str_pad((string) ($this->userSequence++), 3, '0', STR_PAD_LEFT),
            'name' => 'Pemrograman Test',
            'semester' => 1,
            'sks' => 3,
            'rpl_type' => 'hybrid',
            'is_active' => true,
        ], $overrides));
    }

    private function application(array $overrides = []): Application
    {
        $applicantUser = $this->userWithRole('applicant');
        $applicant = $this->applicantFor($applicantUser);
        $studyProgram = $this->studyProgram();

        return Application::create(array_merge([
            'application_number' => 'APP-' . str_pad((string) ($this->userSequence++), 6, '0', STR_PAD_LEFT),
            'applicant_id' => $applicant->id,
            'study_program_id' => $studyProgram->id,
            'rpl_type' => 'hybrid',
            'status' => ApplicationStatus::DRAFT,
            'revision_count' => 0,
        ], $overrides));
    }

    private function assessedApplication(array $overrides = []): Application
    {
        $assessorUser = $this->userWithRole('assessor');
        $assessor = $this->assessorFor($assessorUser);
        $course = $this->course();
        $application = $this->application(array_merge([
            'assigned_assessor_id' => $assessorUser->id,
            'status' => ApplicationStatus::ASSESSED,
        ], $overrides));
        $a1Course = ApplicationA1Course::create([
            'application_id' => $application->id,
            'course_code' => 'EXT-' . $application->id,
            'course_name' => 'Basis Data',
            'credits' => 3,
            'grade' => 'A',
            'institution_name' => 'Universitas Asal',
        ]);
        $assessment = Assessment::create([
            'application_id' => $application->id,
            'assessor_id' => $assessor->id,
            'notes' => 'Direkomendasikan.',
            'recommendation' => 'pass',
            'submitted_at' => now(),
        ]);
        AssessmentCourseMapping::create([
            'assessment_id' => $assessment->id,
            'application_a1_course_id' => $a1Course->id,
            'course_id' => $course->id,
            'is_recognized' => true,
            'notes' => 'Setara.',
        ]);

        return $application;
    }
}
