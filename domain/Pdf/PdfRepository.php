<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Pdf;

use Domain\Pdf\Request\BackgroundRequest;
use FlexPHP\Repositories\Repository;

/**
 * @method PdfGateway getGateway
 */
final class PdfRepository extends Repository
{
    public function background(BackgroundRequest $request): string
    {
        return $this->getGateway()->background($request);
    }
}
