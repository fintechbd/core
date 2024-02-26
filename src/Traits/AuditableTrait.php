<?php

namespace Fintech\Core\Traits;

use Illuminate\Support\Facades\App;
use OwenIt\Auditing\Auditable;

if (App::environment('production')) {
    trait AuditableTrait
    {
        use Auditable;
        use BlameableTrait;
    }
} else {
    trait AuditableTrait
    {
    }
}
