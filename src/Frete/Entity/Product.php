<?php

namespace src\Frete\Entity;

class Product
{
    public string $name;
    public string $price;

    public function getProduto()
    {
        return [
            'name' => $this->name,
            'price' => $this->price
        ];
    }
}