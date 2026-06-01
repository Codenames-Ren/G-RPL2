<?php

namespace App\Enums;

class ApplicationStatus
{
    public const DRAFT = 'draft';

    public const SUBMITTED = 'submitted';

    public const UNDER_REVIEW = 'under_review';

    public const RETURNED = 'returned';

    public const UNDER_ASSESSMENT = 'under_assessment';

    public const ASSESSED = 'assessed';

    public const APPROVED = 'approved';

    public const REJECTED = 'rejected';

    public const ALL = [
        self::DRAFT,
        self::SUBMITTED,
        self::UNDER_REVIEW,
        self::RETURNED,
        self::UNDER_ASSESSMENT,
        self::ASSESSED,
        self::APPROVED,
        self::REJECTED,
    ];
}