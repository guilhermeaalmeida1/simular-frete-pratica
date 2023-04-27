<?php

namespace src\Frete\Entity;

use function PHPUnit\Framework\equalTo;

class Cart
{
    public User $user;

    public array $productList;

    public function totalPrice()
    {
        $total = 0;
        if (empty($this->productList)){
            return 0;
        }

        foreach ($this->productList as $item) {
            $total += $item['price'];
        }

        return $total;
    }

    public function insertCompraCarrinho(array $product)
    {
        if (empty($this->productList)){
            $this->productList[] = [
                "name" => $product['name'],
                "price" => $product['price']
            ];
            return;
        }

        foreach ($this->productList as $listaDeProduto) {
            if ($product['name'] !== $listaDeProduto['name']) {
                $this->productList[] = [
                    "name" => $product['name'],
                    "price" => $product['price']
                ];
            }
        }
    }

    /**
     * @param array|null $product
     * @return int|void
     */
    public function removeCompraCarrinho(array $product = null)
    {
        if (empty($this->productList)){
            return 0;
        }

        foreach ($this->productList as $key => $item) {
            if ($product['name'] === $item['name']) {
                unset($this->productList[$key]);
            }
        }
    }
}