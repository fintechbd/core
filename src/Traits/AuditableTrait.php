<?php

namespace Fintech\Core\Traits;

if (config('audit.enabled', false)) {
    trait AuditableTrait
    {
        use \OwenIt\Auditing\Auditable;
        use BlameableTrait;
    }
} else {
    trait AuditableTrait
    {
    }
}
