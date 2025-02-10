<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Company",
 *     type="object",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Company A"),
 *     @OA\Property(property="buildings", type="array", @OA\Items(ref="#/components/schemas/Building")),
 *     @OA\Property(property="phones", type="array", @OA\Items(ref="#/components/schemas/Phone")),
 *     @OA\Property(property="categories", type="array", @OA\Items(ref="#/components/schemas/Category"))
 * )
 */
class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = ['name'];

    /**
     * Get the buildings associated with the company.
     */
    public function buildings()
    {
        return $this->hasMany(Building::class);
    }

    /**
     * Get the phones associated with the company.
     */
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    /**
     * Get the categories associated with the company.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'company_activity');
    }
}
