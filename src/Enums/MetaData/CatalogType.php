<?php

namespace Fintech\Core\Enums\MetaData;

use Fintech\Core\Traits\HasSerialization;

enum CatalogType: string
{
    use HasSerialization;

    case BloodGroup = 'blood-group'; //seeder
    case FundSource = 'fund-source';
    case Gender = 'gender';
    case IdentityDocument = 'id-document';
    case MaritalStatus = 'marital-status';
    case Occupation = 'occupation';
    case ProofOfAddress = 'proof-of-address';
    case Relation = 'relation';
    case RemittancePurpose = 'remittance-purpose';
}
