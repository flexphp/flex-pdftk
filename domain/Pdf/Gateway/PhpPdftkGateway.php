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
use LogicException;
use mikehaertl\pdftk\Pdf as PdfTk;

final class PhpPdftkGateway implements PdfGateway
{
    public function background(BackgroundRequest $request): string
    {
        $tmpDir = sys_get_temp_dir();
        $tmpBackground = rtrim($tmpDir, DIRECTORY_SEPARATOR) . '/_b' . date('U') . '.fpdf';
        $tmpContent =  rtrim($tmpDir, DIRECTORY_SEPARATOR) . '/_c' . date('U') . '.pdf';
        $tmpResult =  rtrim($tmpDir, DIRECTORY_SEPARATOR) . '/_r' . date('U') . '.pdf';

        \file_put_contents($tmpBackground, \base64_decode($request->background));
        \file_put_contents($tmpContent, \base64_decode($request->content));

        $pdf = new PdfTk($tmpContent, [
            'command' => $_ENV['PDFTK_PATH'] ?? '',
        ]);

        $result = $pdf->background($tmpBackground)->saveAs($tmpResult);

        if ($result === false) {
            throw new LogicException(\sprintf('Error [%s] processing request with id: %d', $pdf->getError(), $request->id));
        }

        $encode = \base64_encode(\file_get_contents($tmpResult));

        \unlink($tmpBackground);
        \unlink($tmpContent);
        \unlink($tmpResult);

        return $encode;
    }
}
