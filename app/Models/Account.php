<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $balance
 */
class Account extends Model
{
    use HasFactory;

    public function create(){}
    public function deposit(){}
    public function withdraw(){}
    public function transfer(){}
}
