<?php

use src\Frete\Entity\Cart;
use src\Frete\Entity\Product;
use src\Frete\Entity\User;
use src\Frete\Service\CarrinhoDeCompra\Compra;
use src\Frete\Service\Shipping\Correios;
use src\Frete\Service\Shipping\ShippingStrategy;

require_once __DIR__ . '/../vendor/autoload.php';

$produto = new Product();
$produto->name = "prod1";
$produto->price = 101;

$usuario = new User();
$usuario->name = "Jhon";
$usuario->zipCode = "123456978";

$carrinho = new Cart();
$carrinho->user = $usuario;
$carrinho->insertCompraCarrinho($produto->getProduto());
$valor = $carrinho->totalPrice();

$correios = new Correios();

$correio = new ShippingStrategy($correios);
$correio->cep = '1231';
$compra = new Compra();

var_dump($compra->calculoDaCompra($valor));