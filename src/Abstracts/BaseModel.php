<?php

namespace Fintech\Core\Abstracts;

class_alias(determine_base_model(), \Fintech\Core\VirtualModel::class);

/**
 * @method string|int getKey()
 * @method void fresh()
 * @method string getKeyName()
 * @method string getTable()
 * @method array modelKeys()
 * @method mixed getAttribute(string $key)
 * @method static \MongoDB\Laravel\Query\Builder|\Illuminate\Database\Eloquent\Builder query()
 * @method void load(string|array $relations)
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null)
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany belongsToMany($related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null)
 * @method \Illuminate\Database\Eloquent\Relations\HasMany hasMany($related, $foreignKey = null, $localKey = null)
 * @method \Illuminate\Database\Eloquent\Relations\HasManyThrough hasManyThrough($related, $through, $firstKey = null, $secondKey = null, $localKey = null, $secondLocalKey = null)
 * @method \Illuminate\Database\Eloquent\Relations\HasOne hasOne($related, $foreignKey = null, $localKey = null)
 * @method \Illuminate\Database\Eloquent\Relations\HasOneThrough hasOneThrough($related, $through, $firstKey = null, $secondKey = null, $localKey = null, $secondLocalKey = null)
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany morphMany($related, $name, $type = null, $id = null, $localKey = null)
 * @method \Illuminate\Database\Eloquent\Relations\MorphOne morphOne($related, $name, $type = null, $id = null, $localKey = null)
 * @method \Illuminate\Database\Eloquent\Relations\MorphTo morphTo($name = null, $type = null, $id = null, $ownerKey = null)
 * @method \Illuminate\Database\Eloquent\Relations\MorphToMany morphToMany($related, $name, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null, $inverse = false)
 * @method \Illuminate\Database\Eloquent\Relations\MorphToMany morphedByMany($related, $name, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null)
 * @see \Illuminate\Database\Eloquent\Concerns\HasRelationships
 * @const string|null CREATED_AT
 * @const string|null UPDATED_AT
 * @extends \Illuminate\Database\Eloquent\Model
 */
class BaseModel extends \Fintech\Core\VirtualModel
{
    protected $collection;
}
