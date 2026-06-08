<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Course;
use App\Models\StudyProgram;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExistingDatabaseSmokeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (config('database.default') === 'sqlite') {
            $this->markTestSkipped('Existing database smoke tests only run against the configured local database.');
        }
    }

    public function test_existing_database_has_required_role_users_and_master_data(): void
    {
        foreach (['applicant', 'staff_rpl', 'assessor', 'committee', 'system_admin'] as $role) {
            $this->assertNotNull($this->userForRole($role), "Missing user for role {$role}.");
        }

        $this->assertGreaterThan(0, StudyProgram::count(), 'Missing study program data.');
        $this->assertGreaterThan(0, Course::count(), 'Missing course data.');
    }

    public function test_existing_database_users_can_access_auth_and_shared_study_program_api(): void
    {
        foreach (['applicant', 'staff_rpl', 'assessor', 'committee', 'system_admin'] as $role) {
            Sanctum::actingAs($this->requireUserForRole($role));

            $this->getJson('/api/auth/me')
                ->assertOk()
                ->assertJsonPath('success', true);

            $this->getJson('/api/study-programs')
                ->assertOk()
                ->assertJsonPath('success', true);
        }
    }

    public function test_existing_database_applicant_endpoints_are_readable(): void
    {
        $applicant = $this->requireUserForRole('applicant');

        if (! $applicant->applicant) {
            $this->markTestSkipped('Applicant role user does not have an applicant profile row.');
        }

        Sanctum::actingAs($applicant);

        $this->getJson('/api/applicant/profile')
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->getJson('/api/applicant/applications')
            ->assertOk()
            ->assertJsonPath('success', true);

        $application = Application::query()
            ->where('applicant_id', $applicant->applicant->id)
            ->first();

        if ($application) {
            $this->getJson("/api/applicant/applications/{$application->id}")
                ->assertOk()
                ->assertJsonPath('success', true);
        }
    }

    public function test_existing_database_staff_endpoints_are_readable(): void
    {
        Sanctum::actingAs($this->requireUserForRole('staff_rpl'));

        $this->getJson('/api/staff/assessors')
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->getJson('/api/staff/submissions')
            ->assertOk()
            ->assertJsonPath('success', true);

        $application = Application::query()
            ->whereIn('status', ['submitted', 'under_review', 'returned'])
            ->first();

        if ($application) {
            $this->getJson("/api/staff/submissions/{$application->id}")
                ->assertOk()
                ->assertJsonPath('success', true);
        }
    }

    public function test_existing_database_assessor_endpoints_are_readable(): void
    {
        $assessor = $this->requireUserForRole('assessor');

        if (! $assessor->assessor) {
            $this->markTestSkipped('Assessor role user does not have an assessor profile row.');
        }

        Sanctum::actingAs($assessor);

        $this->getJson('/api/assessor/assessments')
            ->assertOk()
            ->assertJsonPath('success', true);

        $application = Application::query()
            ->where('assigned_assessor_id', $assessor->id)
            ->where('status', 'under_assessment')
            ->first();

        if ($application) {
            $this->getJson("/api/assessor/assessments/{$application->id}")
                ->assertOk()
                ->assertJsonPath('success', true);
        }
    }

    public function test_existing_database_committee_endpoints_are_readable(): void
    {
        Sanctum::actingAs($this->requireUserForRole('committee'));

        $this->getJson('/api/committee/applications')
            ->assertOk()
            ->assertJsonPath('success', true);

        $assessedApplication = Application::query()
            ->whereIn('status', ['assessed', 'approved'])
            ->first();

        if ($assessedApplication) {
            $this->getJson("/api/committee/applications/{$assessedApplication->id}")
                ->assertOk()
                ->assertJsonPath('success', true);
        }

        $this->getJson('/api/committee/applications/approved')
            ->assertOk()
            ->assertJsonPath('success', true);

        $approvedApplication = Application::query()
            ->where('status', 'approved')
            ->first();

        if ($approvedApplication) {
            $this->getJson("/api/committee/applications/approved/{$approvedApplication->id}")
                ->assertOk()
                ->assertJsonPath('success', true);
        }
    }

    public function test_existing_database_admin_endpoints_are_readable(): void
    {
        Sanctum::actingAs($this->requireUserForRole('system_admin'));

        $this->getJson('/api/admin/study-programs')
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->getJson('/api/admin/courses')
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->getJson('/api/admin/users')
            ->assertOk()
            ->assertJsonPath('success', true);

        $studyProgram = StudyProgram::first();
        $course = Course::first();
        $user = User::query()->whereHas('roles')->first();

        if ($studyProgram) {
            $this->getJson("/api/admin/study-programs/{$studyProgram->id}")
                ->assertOk()
                ->assertJsonPath('success', true);
        }

        if ($course) {
            $this->getJson("/api/admin/courses/{$course->id}")
                ->assertOk()
                ->assertJsonPath('success', true);
        }

        if ($user) {
            $this->getJson("/api/admin/users/{$user->id}")
                ->assertOk()
                ->assertJsonPath('success', true);
        }
    }

    private function requireUserForRole(string $role): User
    {
        $user = $this->userForRole($role);

        if (! $user) {
            $this->markTestSkipped("No existing user found for role {$role}.");
        }

        return $user;
    }

    private function userForRole(string $role): ?User
    {
        return User::query()
            ->role($role)
            ->with(['applicant', 'assessor'])
            ->first();
    }
}
