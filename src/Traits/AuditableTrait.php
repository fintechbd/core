<?php

namespace Fintech\Core\Traits;

use Illuminate\Support\Facades\App;
use OwenIt\Auditing\Auditable;

if (class_exists('OwenIt\Auditing\Auditable')) {
    trait OwenItAuditable
    {
        use Auditable;
    }
} else {
    trait OwenItAuditable
    {
    }
}

if (config('fintech.core.blameable_enabled', false)) {
    trait ModelBlameable
    {
        use BlameableTrait;
    }
} else {
    trait ModelBlameable
    {
    }
}

if (App::environment('production')) {
    trait AuditableTrait
    {
        use OwenItAuditable;
        use ModelBlameable;
    }
} else {
    trait AuditableTrait
    {
    }
}
