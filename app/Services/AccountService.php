<?php

namespace App\Services;

use App\Interfaces\AccountInterface;
use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AccountService implements AccountInterface
{
    /**
     * Get Account by Id.
     *
     * @param int $id
     *
     * @return Account
     */
    public function getById($id): Account
    {
        /** @var Account */
        $account = Account::find($id);
        if($account == null){
            return new Account();
        }

        return $account;
    }

    /**
     * Get All Accounts.
     *
     * @return Collection<Account>
     */
    public function getAccounts(): Collection
    {
        return Account::get();
    }

    /**
     * Delete all Accounts.
     *
     * @return bool
     */
    public function reset(): bool
    {
        foreach($this->getAccounts() as $account){
            $account->delete();
        }
        return true;
    }

    /**
     * Deposit amount on balance Account.
     *
     * @param Request $account
     *
     * @return array<Account>
     */
    public function deposit($account): array
    {
        /** @var Account */
        $accountObj = $this->getById($account->destination);

        /** @var array<int> */
        $search = ['id' => $account->destination];
        /** @var array<int,int> */
        $data = [
            'id' => $account->destination,
            'balance' => $accountObj->balance + $account->amount
        ];

        /** @var Account */
        $accountObj = Account::updateOrCreate($search, $data);

        /** @var array */
        $filteredData = [
            'id' => $accountObj->id,
            'balance' => $accountObj->balance
        ];

        return ['destination' => $filteredData];
    }

    /**
     * Withdraw amount on balance Account
     *
     * @param Request $account
     *
     * @return array<Account>
     */
    public function withdraw($account): array
    {
        /** @var Account */
        $accountObj = $this->getById($account->origin);
        $accountObj->update(['balance' => $accountObj->balance - $account->amount]);

        /** @var array */
        $filteredData = [
            'id' => $accountObj->id,
            'balance' => $accountObj->balance
        ];

        return ['origin' => $filteredData];
    }

    /**
     * Transfer amount between Accounts
     *
     * @param Request $account
     *
     * @return array<Account>
     */
    public function transfer($account): array
    {
        /** @var Account */
        $origin = $this->withdraw($account);
        /** @var Account */
        $destination = $this->deposit($account);

        $filteredData = [
            'origin' => $origin['origin'],
            'destination' => $destination['destination'],
        ];

        return $filteredData;
    }
}
