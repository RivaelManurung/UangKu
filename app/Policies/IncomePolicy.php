<?php

namespace App\Policies;

use App\Models\Income;
use App\Models\User;

class IncomePolicy
{
    /**
     * Determine whether the user can view any incomes.
     */
    public function viewAny(User $user): bool
    {
        // Biasanya semua user bisa lihat list income mereka sendiri
        return true;
    }

    /**
     * Determine whether the user can view the income.
     */
    public function view(User $user, Income $income): bool
    {
        return $user->id === $income->user_id;
    }

    /**
     * Determine whether the user can create incomes.
     */
    public function create(User $user): bool
    {
        // Semua user yang login bisa create income
        return true;
    }

    /**
     * Determine whether the user can update the income.
     */
    public function update(User $user, Income $income): bool
    {
        return $user->id === $income->user_id;
    }

    /**
     * Determine whether the user can delete the income.
     */
    public function delete(User $user, Income $income): bool
    {
        return $user->id === $income->user_id;
    }
}
