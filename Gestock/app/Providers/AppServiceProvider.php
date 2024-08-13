<?php

namespace App\Providers;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Policies\OrderItemPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    
    protected $policies = [
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
        Category::class => CategoryPolicy::class,
        Supplier::class => SupplierPolicy::class,
        Customer::class => CustomerPolicy::class,
        Order::class => OrderPolicy::class,
        OrderItem::class => OrderItemPolicy::class,
        Inventory::class => InventoryPolicy::class,
    ];
    public function boot(): void
    {
        $this->registerPolicies();
    }
   
    
    
}
