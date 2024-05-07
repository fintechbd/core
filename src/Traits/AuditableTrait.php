<?php

namespace Fintech\Core\Traits;

use Illuminate\Support\Facades\App;


if (class_exists('OwenIt\Auditing\Auditable')) {
    trait OwenItAuditable
    {
        use \OwenIt\Auditing\Auditable;
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
