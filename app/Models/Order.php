<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'cliente_id',
        'user_deliveryman_id',
        'total',
        'status',
        'cupom_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function cupom()
    {
        return $this->belongsTo(Cupom::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deliveryman()
    {   
        return $this->belongsTo(User::class, 'user_deliveryman_id', 'id');
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

}
