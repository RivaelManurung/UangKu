<?php

namespace App\Policies;

use App\Models\Balance;
use App\Models\User;

class BalancePolicy
{
    /**
     * Determine whether the user can view any balances.
     */
    public function viewAny(User $user): bool
    {
        return true; // user bisa lihat daftar balance miliknya sendiri
    }

    /**
     * Determine whether the user can view the balance.
     */
    public function view(User $user, Balance $balance): bool
    {
        return $user->id === $balance->user_id;
    }

    /**
     * Determine whether the user can create balances.
     */
    public function create(User $user): bool
    {
        return true; // user yang login bisa buat balance baru
    }

    /**
     * Determine whether the user can update the balance.
     */
    public function update(User $user, Balance $balance): bool
    {
        return $user->id === $balance->user_id;
    }

    /**
     * Determine whether the user can delete the balance.
     */
    public function delete(User $user, Balance $balance): bool
    {
        return $user->id === $balance->user_id;
    }
}
