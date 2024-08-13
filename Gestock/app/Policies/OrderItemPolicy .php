<?php

namespace App\Policies;

use App\Models\OrderItem;
use App\Models\User;


class OrderItemPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

    public function view(User $user, OrderItem $orderItem): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

    public function update(User $user, OrderItem $orderItem): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

    public function delete(User $user, OrderItem $orderItem): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }
}
