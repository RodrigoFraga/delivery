<?php

use Delivery\Models\Order;
use Delivery\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create()->each( function($o){
        	for ($i=0; $i <=3 ; $i++) { 
        		$o->items()->save( factory(OrderItem::class)->make([
                    'produto_id' => rand(1,8),
                    'qtd' => 2,
                    'preco' => 50
                ]));
        	}
        });
    }
}
