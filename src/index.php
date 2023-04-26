<?php

use src\Frete\Entidades\Carrinho;
use src\Frete\Entidades\Produto;
use src\Frete\Entidades\Usuario;
use src\Frete\Service\CarrinhoDeCompra\Compra;
use src\Frete\Service\Shipping\Correios;
use src\Frete\Service\Shipping\ShippingStrategy;

require_once __DIR__ . '/../vendor/autoload.php';

$produto = new Produto();
$produto->nome = "prod1";
$produto->valor = 101;

$usuario = new Usuario();
$usuario->nome = "Jhon";
$usuario->cep = "123456978";

$carrinho = new Carrinho();
$carrinho->usuario = $usuario;
$carrinho->insertCompraCarrinho($produto->getProduto());
$valor = $carrinho->valorTotalDoCarrinho();

$correios = new Correios();

$correio = new ShippingStrategy($correios);
$correio->cep = '1231';
$compra = new Compra();

var_dump($compra->calculoDaCompra($valor));