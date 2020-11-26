<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Pdf\Request;

use FlexPHP\Messages\RequestInterface;

class BackgroundRequest implements RequestInterface
{
    public $type;

    public $id;

    public $background;

    public $content;

    public $encode;

    public function __construct(array $params)
    {
        $this->type = $params['data']['type'] ?? null;
        $this->id = $params['data']['id'] ?? null;

        $this->background = $params['data']['attributes']['background'] ?? null;
        $this->content = $params['data']['attributes']['content'] ?? null;
        $this->encode = $params['data']['attributes']['encode'] ?? null;
    }
}
