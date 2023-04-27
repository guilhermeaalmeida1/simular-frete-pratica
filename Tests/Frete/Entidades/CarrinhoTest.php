<?php

namespace Tests\Frete\Entidades;

use PHPUnit\Framework\Attributes\CoversClass;
use src\Frete\Entity\Cart;
use PHPUnit\Framework\TestCase;
use src\Frete\Entity\Product;
use src\Frete\Entity\User;
use src\Frete\Service\CarrinhoDeCompra\Compra;
use src\Frete\Service\Shipping\Correios;
use src\Frete\Service\Shipping\ShippingStrategy;
use src\Frete\Service\Shipping\ShippingInterface;
use Mockery;

#[CoversClass(User::class)]
#[CoversClass(Cart::class)]
#[CoversClass(Product::class)]
#[CoversClass(Compra::class)]
#[CoversClass(Correios::class)]
#[CoversClass(ShippingStrategy::class)]

class CarrinhoTest extends TestCase
{
    public User $usuario;
    public Cart $carrinho;
    public Product $produto;

    protected function setUp():void
    {
        $this->usuario = new User();

        $this->carrinho = new Cart();

        $this->produto = new Product();
    }

    public function testTotalPriceIfWasEmpty()
    {
        $this->usuario->name = "Jhon";
        $this->usuario->zipCode = "123456978";
        $this->carrinho->user = $this->usuario;

        $this->assertEquals($this->carrinho->totalPrice(), 0);

    }

    public function testTotalPriceIfCartHaveOneProduct()
    {
        $this->produto->name = "prod1";
        $this->produto->price = 10;

        $this->usuario->name = "Jhon";
        $this->usuario->zipCode = "123456978";
        $this->carrinho->user = $this->usuario;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->assertEquals($this->carrinho->totalPrice(), 10);
    }

    public function testTotalPriceIfCartHaveMoreThanOneProduct()
    {
        $this->produto->name = "prod1";
        $this->produto->price = 10;

        $this->usuario->name = "Jhon";
        $this->usuario->zipCode = "123456978";
        $this->carrinho->user = $this->usuario;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->produto->name = "prod12";
        $this->produto->price = 10;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->assertEquals($this->carrinho->totalPrice(), 20);
    }

    public function testTotalPriceIfCartHaveSameProducts()
    {
        $this->produto->name = "prod1";
        $this->produto->price = 10;

        $this->usuario->name = "Jhon";
        $this->usuario->zipCode = "123456978";
        $this->carrinho->user = $this->usuario;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->produto->name = "prod1";
        $this->produto->price = 10;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->assertEquals($this->carrinho->totalPrice(), 10);
    }

    public function testRemoveProductFromCart()
    {
        $this->produto->name = "prod1";
        $this->produto->price = 10;

        $this->usuario->name = "Jhon";
        $this->usuario->zipCode = "123456978";
        $this->carrinho->user = $this->usuario;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->produto->name = "prod12";
        $this->produto->price = 10;
        $this->carrinho->insertCompraCarrinho($this->produto->getProduto());

        $this->carrinho->removeCompraCarrinho($this->produto->getProduto());

        $this->assertEquals($this->carrinho->totalPrice(), 10);
    }

    public function testRemoveProductFromAEmptyCart()
    {
        $this->assertEquals($this->carrinho->removeCompraCarrinho(), 0);
    }

    public function tearDown():void
    {
        Mockery::close();
    }
}
