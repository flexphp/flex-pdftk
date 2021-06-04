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
    // Global Users Object
    $file = __DIR__ . '/passwd.php';

    $containerBuilder->addDefinitions([
        'credentials' => \file_exists($file) ? require($file) : [],
    ]);
};
