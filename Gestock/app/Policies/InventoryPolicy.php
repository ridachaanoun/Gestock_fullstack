<?php

namespace App\Policies;

use App\Models\Inventory;
use App\Models\User;

class InventoryPolicy
{
    
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

   
    public function view(User $user, Inventory $inventory): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

    
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

    
    public function update(User $user, Inventory $inventory): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

    
    public function delete(User $user, Inventory $inventory): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }
}
