<?php

namespace Delivery\Services;

use Delivery\Models\Order;
use Delivery\Repositories\ProdutoRepository;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\CupomRepository;


class OrderService
{
    private $produtoRepository;
    private $orderRepository;
	private $cupomRepository;

	public function __construct(ProdutoRepository $produtoRepository, OrderRepository $orderRepository, CupomRepository $cupomRepository)
    {
        $this->produtoRepository = $produtoRepository;
        $this->orderRepository = $orderRepository;
        $this->cupomRepository = $cupomRepository;
    }

    public function create(array $data)
    {
        \DB::beginTransaction();
            try {
                $data['status'] = 0;

                if (isset($data['cupom_id'])) {
                    unset($data['cupom_id']);
                }

                if ( isset($data['cupom_code']) ) {
                    $cupom = $this->cupomRepository->findByField('code', $data['cupom_code'])->first();
                    $data['cupom_id'] = $cupom->id;
                    $cupom->used = 1;
                    $cupom->save();
                    unset($data['cupom_code']);
                }

                $items = $data['items'];
                unset($data['items']);

                $order = $this->orderRepository->create($data);
                $total = 0;

                foreach ($items as $item) {
                    $item['preco'] = $this->produtoRepository->find($item['produto_id'])->preco;
                    $order->items()->create($item);
                    $total += $item['preco'] * $item['qtd'];
                }

                $order->total = $total;

                if (isset($cupom)) {
                    $order->total = $total - $cupom->value;
                }

                $order->save();
                \DB::commit();
                return $order;

            } catch (\Exception $e){
                \DB::rollback();
                throw $e;
            }
    }

    public function updateStatus($id, $idDeliveryman, $status)
    {
        $order = $this->orderRepository->getByIdAndDeliveryman($id, $idDeliveryman);

        if ($order instanceof Order) {
            $order->status = $status;
            $order->save();
            return $order;
        }
        return abort(400, "Order não encontrado");
    }
}
