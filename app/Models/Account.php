<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

/**
 * @property int $id
 * @property int $balance
 */
class Account extends Model
{
    use HasFactory;

    public const CREATED_AT = 'dt_inc';
    public const UPDATED_AT = 'dt_alt';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'balance'
    ];
}
