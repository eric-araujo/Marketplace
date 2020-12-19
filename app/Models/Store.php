<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Notifications\StoreReceiveNewOrder;

use App\Traits\Slug;

class Store extends Model
{
    use HasFactory;
    use Slug;

    protected $fillable = ['name', 'description', 'phone', 'mobile_phone','slug', 'logo'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products() 
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
       return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }

    public function notifyStoreOwners(array $storesId = [])
    {
        $stores = \App\Models\Store::whereIn('id', $storesId)->get();

        return $stores->map(function($store){
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder());

    }
}
