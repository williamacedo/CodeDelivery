<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use CodeDelivery\Models\OrderItem;
use CodeDelivery\Models\User;
use CodeDelivery\Models\Product;
use CodeDelivery\Models\Client;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'client_id',
        'user_deliveryman_id',
        'total',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deliveryman()
    {
        return $this->belongsTo(User::class, 'user_deliveryman_id', 'id');
    }

    public function products() {

        return $this->hasMany(Product::class);
    }

}
