<?php

namespace src\Frete;

use DI\ContainerBuilder;
use src\Frete\Service\Correios\Correios;
use src\Frete\Service\Correios\CorreiosInterface;

class DIConfig
{

    public function build()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions([
            CorreiosInterface::class => function ($container) {
                return $container->get(Correios::class);
            }
        ]);

        $builder->build();
    }

}