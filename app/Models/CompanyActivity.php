<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="CompanyActivity",
 *     type="object",
 *     required={"company_id", "category_id"},
 *     @OA\Property(property="company_id", type="integer", example=1),
 *     @OA\Property(property="category_id", type="integer", example=2)
 * )
 */
class CompanyActivity extends Pivot
{
    use HasFactory;

    protected $table = 'company_activity';

    protected $fillable = ['company_id', 'category_id'];
}
