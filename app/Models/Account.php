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
        'balance'
    ];

    /**
     * Deposit or Create an Account.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function deposit($request){
        $this->id = $request->destination;
        $this->balance = $this->balance + $request->amount;
        $this->save();

        return response()->json(['destination' => ['id' => $this->id, 'balance' => $this->balance]]);
    }
    public function withdraw(){
    }
    public function transfer(){}
}
