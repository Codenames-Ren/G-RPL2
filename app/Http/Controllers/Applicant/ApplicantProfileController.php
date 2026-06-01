<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;

use App\Http\Requests\Applicant\Profile\UpdateApplicantProfileRequest;

use App\Services\ApplicantProfileService;

use Illuminate\Http\Request;

class ApplicantProfileController extends Controller
{
    public function __construct(
        protected ApplicantProfileService $applicantProfileService
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Get Profile
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request
    )
    {
        return response()->json([

            'success' => true,

            'data'
                => $this->applicantProfileService->show(
                    $request->user()->applicant
                ),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Profile
    |--------------------------------------------------------------------------
    */

    public function update(
        UpdateApplicantProfileRequest $request
    )
    {
        return response()->json([

            'success' => true,

            'message'
                => 'Profile updated successfully.',

            'data'
                => $this->applicantProfileService->update(
                    $request->user()->applicant,
                    $request->validated()
                ),
        ]);
    }
}