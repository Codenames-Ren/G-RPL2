<?php

namespace App\Enums;

class ApplicationStatus
{
    const DRAFT = 'draft';
    const SUBMITTED = 'submitted';
    const VERIFIED = 'verified';
    const UNDER_ASSESSMENT = 'under_assessment';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';
    const COMPLETED = 'completed';
}