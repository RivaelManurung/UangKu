<?php

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpensePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any expenses.
     */
    public function viewAny(User $user): bool
    {
        // Misal semua user bisa lihat expenses miliknya
        return true;
    }

    /**
     * Determine whether the user can view the expense.
     */
    public function view(User $user, Expense $expense): bool
    {
        // User hanya bisa lihat expense miliknya
        return $user->id === $expense->user_id;
    }

    /**
     * Determine whether the user can create expenses.
     */
    public function create(User $user): bool
    {
        // User yang sudah login bisa membuat expense
        return true;
    }

    /**
     * Determine whether the user can update the expense.
     */
    public function update(User $user, Expense $expense): bool
    {
        // User hanya bisa update expense miliknya
        return $user->id === $expense->user_id;
    }

    /**
     * Determine whether the user can delete the expense.
     */
    public function delete(User $user, Expense $expense): bool
    {
        // User hanya bisa delete expense miliknya
        return $user->id === $expense->user_id;
    }

    /**
     * Determine whether the user can restore the expense.
     */
    public function restore(User $user, Expense $expense): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the expense.
     */
    public function forceDelete(User $user, Expense $expense): bool
    {
        return false;
    }
}
