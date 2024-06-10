<?php

namespace App\Http\Controllers;

use App\Interfaces\AccountInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct(public AccountInterface $account)
    {
    }

    /**
     * Delete all data from Account
     *
     * @return JsonResponse
     */
    public function reset(): JsonResponse
    {
        $this->account->reset();

        return response()->json("OK", 200);
    }

    /**
     * Get balance of account.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function balance(Request $request): JsonResponse
    {
        /** @var Account */
        $account = $this->account->getById($request->account_id);

        return $account->id ?
            response()->json($account->balance, 200) :
            response()->json(0, 404);
    }

    /**
     * Performs deposit, withdrawal, and transfer transactions on accounts.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function event(Request $request): JsonResponse
    {
        switch ($request->type) {
            case 'deposit':
                return response()->json(
                    $this->account->deposit($request),
                        201);
            case 'withdraw':
                return $this->account->getById($request->origin)->id ?
                    response()->json($this->account->withdraw($request), 201) :
                    response()->json(0, 404);
            case 'transfer':
                return !$this->account->getById($request->origin)->id ?
                    response()->json(0, 404) :
                    response()->json($this->account->transfer($request), 201);
            default:
                return response()->json(0, 500);
        }
    }
}
