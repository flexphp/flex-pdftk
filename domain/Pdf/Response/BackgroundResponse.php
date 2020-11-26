<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Pdf\Response;

use FlexPHP\Messages\ResponseInterface;

class BackgroundResponse implements ResponseInterface
{
    public $content;

    public $encode;

    public function __construct(string $content, string $encode = 'base64')
    {
        $this->content = $content;
        $this->encode = $encode;
    }
}
