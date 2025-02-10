<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Phone",
 *     type="object",
 *     required={"id", "company_id", "phone_number"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="phone_number", type="string", example="+1234567890"),
 *     @OA\Property(property="company", ref="#/components/schemas/Company")
 * )
 */
class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'phone_number'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
