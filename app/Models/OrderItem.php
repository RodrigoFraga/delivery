<?php

namespace Delivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OrderItem extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'produto_id',
        'order_id',
        'preco',
        'qtd'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function produto()
    {   
        return $this->belongsTo(Produto::class);
    }

}
