<?php

namespace Fintech\Core\Abstracts;

use Carbon\Carbon;
use Fintech\Core\Enums\Auth\RiskProfile;
use Fintech\Core\Enums\RequestPlatform;
use Fintech\Core\Enums\Transaction\OrderStatus;
use Fintech\Core\Enums\Transaction\OrderType;
use Fintech\Core\VirtualModel;
use Fintech\Transaction\Models\OrderDetail;
use Fintech\Transaction\Models\TransactionForm;
use Fintech\Transaction\Traits\HasOrderAttributes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class_alias(determine_base_model(), VirtualModel::class);

/**
 * @property int|null $id
 * @method string|int getKey()
 * @method void fresh()
 * @method bool save()
 * @method void refresh()
 * @method string getKeyName()
 * @method string getTable()
 * @method array modelKeys()
 * @method array toArray()
 * @method self setVisible(array $fields = [])
 * @method self setHidden(array $fields = [])
 * @method string toJson()
 * @method mixed getAttribute(string $key)
 * @method static \MongoDB\Laravel\Query\Builder|Builder query()
 * @method void load(string|array $relations)
 * @method BelongsTo belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null)
 * @method BelongsToMany belongsToMany($related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null)
 * @method HasMany hasMany($related, $foreignKey = null, $localKey = null)
 * @method HasManyThrough hasManyThrough($related, $through, $firstKey = null, $secondKey = null, $localKey = null, $secondLocalKey = null)
 * @method HasOne hasOne($related, $foreignKey = null, $localKey = null)
 * @method HasOneThrough hasOneThrough($related, $through, $firstKey = null, $secondKey = null, $localKey = null, $secondLocalKey = null)
 * @method MorphMany morphMany($related, $name, $type = null, $id = null, $localKey = null)
 * @method MorphOne morphOne($related, $name, $type = null, $id = null, $localKey = null)
 * @method MorphTo morphTo($name = null, $type = null, $id = null, $ownerKey = null)
 * @method MorphToMany morphToMany($related, $name, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null, $inverse = false)
 * @method MorphToMany morphedByMany($related, $name, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null)
 *
 * @see \Illuminate\Database\Eloquent\Concerns\HasRelationships
 *
 * @const string|null CREATED_AT
 * @const string|null UPDATED_AT
 *
 *
 * @extends Model
 */
class BaseModel extends VirtualModel
{
    protected $collection;

    public function __debugInfo(): ?array
    {
        return $this->attributes;
    }
}
