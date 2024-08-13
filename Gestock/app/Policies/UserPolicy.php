<?php

namespace App\Policies;

use App\Models\User;
use App\Models\User as ModelUser;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Temporarily allow all access for testing
    }
    
    public function view(User $user, ModelUser $modelUser): bool
    {
        return true; // Temporarily allow all access for testing
    }
    
    public function create(User $user): bool
    {
        return true; // Temporarily allow all access for testing
    }
    
    public function update(User $user, ModelUser $modelUser): bool
    {
        return true; // Temporarily allow all access for testing
    }
    
    public function delete(User $user, ModelUser $modelUser): bool
    {
        return true; // Temporarily allow all access for testing
    }
    
}
