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

final class PdfRepository
{
    private PdfGateway $pdfGateway;

    public function __construct(PdfGateway $pdfGateway)
    {
        $this->pdfGateway = $pdfGateway;
    }

    public function background(BackgroundRequest $request): string
    {
        return $this->pdfGateway->background($request);
    }
}
