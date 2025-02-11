<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Category",
 *     type="object",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Мясные"),
 *     @OA\Property(property="parent", ref="#/components/schemas/Category"),
 *     @OA\Property(property="children", type="array", @OA\Items(ref="#/components/schemas/Category")),
 *     @OA\Property(property="companies", type="array", @OA\Items(ref="#/components/schemas/Company"))
 * )
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_activity');
    }
}
