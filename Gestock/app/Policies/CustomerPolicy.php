<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
{
    
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

  
    public function view(User $user, Customer $customer): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

   
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }

  
    public function update(User $user, Customer $customer): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }


    public function delete(User $user, Customer $customer): bool
    {
        return in_array($user->role, ['admin', 'user']);
    }
}
