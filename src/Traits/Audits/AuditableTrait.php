<?php

namespace Fintech\Core\Traits\Audits;

use Fintech\Core\Traits\Audits;

if (config('audit.enabled', false)) {
    trait AuditableTrait
    {
        use \OwenIt\Auditing\Auditable;
        use Audits\BlameableTrait;
    }
} else {
    trait AuditableTrait
    {
    }
}
