<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Returns Balance.
     */
    public function balance(Request $request): JsonResponse
    {
        return Account::find($request->account_id) != null ?
            response()->json(Account::find($request->id)->balance, 200) :
            response()->json(0, 404);
    }

    /**
     * Returns Balance.
     */
    public function event(Request $request): JsonResponse
    {
        return Account::find($request->destination) ? Account::find($request->destination)->deposit($request) : (new Account())->deposit($request);
    }
}
