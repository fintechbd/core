<?php

namespace Fintech\Core\Enums\MetaData;

use Fintech\Core\Traits\HasSerialization;

enum CatalogType: string
{
    use HasSerialization;

    case Gender = 'gender';
    case BloodGroup = 'blood-group';
    case MaritalStatus = 'marital-status';
}
