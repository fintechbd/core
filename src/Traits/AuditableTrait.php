<?php

namespace Fintech\Core\Traits;

use Illuminate\Support\Facades\App;

if (App::environment('production')) {
    trait AuditableTrait
    {
        use \OwenIt\Auditing\Auditable;
        use \Fintech\Core\Traits\BlameableTrait;
    }
} else {
    trait AuditableTrait
    {
    }
}
