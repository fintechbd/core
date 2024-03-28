<?php

namespace Fintech\Core\Enums\MetaData;

use Fintech\Core\Traits\HasSerialization;

enum CatalogType: string
{
    use HasSerialization;

    case Gender = 'gender'; //done
    case BloodGroup = 'blood-group';
    case MaritalStatus = 'marital-status'; //done
    case FundSource = 'fund-source'; //done
    case IdentityDocument = 'id-document'; //done
    case AddressProof = 'address-proof'; //done
    case Occupation = 'occupation'; //done
    case Relation = 'relation';//done
    case RemittancePurpose = 'remittance-purpose'; //done
}
