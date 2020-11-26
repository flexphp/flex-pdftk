<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder): void {
    $containerBuilder->addDefinitions([
        \Domain\Pdf\PdfGateway::class => \DI\autowire(\Domain\Pdf\Gateway\PhpPdftkGateway::class),
        // \Domain\Pdf\PdfGateway::class => \DI\autowire(\Domain\Pdf\Gateway\CommandPdftkGateway::class),
    ]);
};
