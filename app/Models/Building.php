<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Building",
 *     type="object",
 *     required={"id", "address", "company_id"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="address", type="string", example="1234 Street Name"),
 *     @OA\Property(property="coordinates", type="array", @OA\Items(type="float"), example={"lat": 40.7128, "lng": -74.0060}),
 *     @OA\Property(property="company", ref="#/components/schemas/Company")
 * )
 */
class Building extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'coordinates', 'company_id'];

    protected $casts = [
        'coordinates' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
