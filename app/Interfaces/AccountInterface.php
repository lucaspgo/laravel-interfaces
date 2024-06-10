<?php

namespace App\Interfaces;

use App\Models\Account;

interface AccountInterface {
    public function getById($id): Account;
    public function deposit($account): array;
    public function withdraw($account): array;
    public function transfer($account): array;
    public function reset(): bool|null;
}
