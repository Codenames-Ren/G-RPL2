<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class FrontendRoutingTest extends TestCase
{
    #[DataProvider('pageRoutes')]
    public function test_frontend_pages_render_with_expected_page_and_role_metadata(
        string $route,
        string $page,
        bool $authRequired = false,
        ?string $roleRequired = null
    ): void {
        $response = $this->get($route);

        $response
            ->assertOk()
            ->assertSee('data-page="' . $page . '"', false)
            ->assertSee('data-auth-required="' . ($authRequired ? 'true' : 'false') . '"', false);

        if ($roleRequired !== null) {
            $response->assertSee('data-role-required="' . $roleRequired . '"', false);
        }
    }

    public function test_legacy_admin_shortcuts_redirect_to_current_admin_routes(): void
    {
        $this->get('/master-data')->assertRedirect('/admin/master-data');
        $this->get('/users')->assertRedirect('/admin/users');
    }

    public static function pageRoutes(): array
    {
        return [
            'home' => ['/', 'home'],
            'about' => ['/tentang-rpl', 'about'],
            'requirements' => ['/persyaratan', 'requirements'],
            'faq' => ['/faq', 'faq'],
            'announcements' => ['/pengumuman', 'announcements'],
            'login' => ['/login', 'login'],
            'register' => ['/register', 'register'],
            'dashboard' => ['/dashboard', 'dashboard', true],
            'applicant profile' => ['/profile', 'profile', true, 'applicant'],
            'applicant profile edit' => ['/profile/edit', 'profile-edit', true, 'applicant'],
            'applicant applications' => ['/applications', 'applications', true, 'applicant'],
            'applicant application create' => ['/applications/create', 'applications-create', true, 'applicant'],
            'applicant application detail' => ['/applications/1', 'application-detail', true, 'applicant'],
            'applicant application edit' => ['/applications/1/edit', 'application-edit', true, 'applicant'],
            'assessor assessments' => ['/assessments', 'assessments', true, 'assessor'],
            'assessor assessment detail' => ['/assessments/1', 'assessment-detail', true, 'assessor'],
            'committee approvals' => ['/approvals', 'approvals', true, 'committee'],
            'committee approved approvals' => ['/approvals/approved', 'approvals-approved', true, 'committee'],
            'committee approval detail' => ['/approvals/1', 'approval-detail', true, 'committee'],
            'staff submissions' => ['/submissions', 'submissions', true, 'staff_rpl'],
            'staff submission detail' => ['/submissions/1', 'submission-detail', true, 'staff_rpl'],
            'admin master data' => ['/admin/master-data', 'master-data', true, 'system_admin'],
            'admin users' => ['/admin/users', 'users', true, 'system_admin'],
            'admin user create' => ['/admin/users/create', 'users-create', true, 'system_admin'],
            'admin user edit' => ['/admin/users/1/edit', 'users-edit', true, 'system_admin'],
            'admin study programs' => ['/admin/study-programs', 'study-programs', true, 'system_admin'],
            'admin study program create' => ['/admin/study-programs/create', 'study-programs-create', true, 'system_admin'],
            'admin study program edit' => ['/admin/study-programs/1/edit', 'study-programs-edit', true, 'system_admin'],
            'admin courses' => ['/admin/courses', 'courses', true, 'system_admin'],
            'admin course create' => ['/admin/courses/create', 'courses-create', true, 'system_admin'],
            'admin course edit' => ['/admin/courses/1/edit', 'courses-edit', true, 'system_admin'],
        ];
    }
}
