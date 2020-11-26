<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Pdf\Gateway;

use Domain\Pdf\PdfGateway;
use Domain\Pdf\Request\BackgroundRequest;

final class PhpPdftkGateway implements PdfGateway
{
    public function background(BackgroundRequest $request): string
    {
        return __FILE__;
    }
}
