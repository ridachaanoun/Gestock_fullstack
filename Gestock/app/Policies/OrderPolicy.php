<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

    
    public function view(User $user, Order $order): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

   
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

   
    public function update(User $user, Order $order): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

    
    public function delete(User $user, Order $order): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }
}
