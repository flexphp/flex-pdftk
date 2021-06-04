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
use Exception;

final class CommandPdftkGateway implements PdfGateway
{
    public function background(BackgroundRequest $request): string
    {
        $tmpDir = \sys_get_temp_dir();
        $tmpBackground = \rtrim($tmpDir, \DIRECTORY_SEPARATOR) . '/_b' . \date('U') . '.pdf';
        $tmpContent = \rtrim($tmpDir, \DIRECTORY_SEPARATOR) . '/_c' . \date('U') . '.pdf';
        $tmpResult = \rtrim($tmpDir, \DIRECTORY_SEPARATOR) . '/_r' . \date('U') . '.pdf';

        if (empty($_ENV['PDFTK_PATH'])) {
            throw new Exception('PdfTK not defined', 400);
        }

        \file_put_contents($tmpBackground, \base64_decode($request->background));

        if (!\file_exists($tmpBackground)) {
            throw new Exception('File [Background] not found', 400);
        }

        \file_put_contents($tmpContent, \base64_decode($request->content));

        if (!\file_exists($tmpContent)) {
            throw new Exception('File [Content] not found', 400);
        }

        $response = [];
        $command = \sprintf(
            '%s %s background %s output %s 2>&1',
            \escapeshellarg($_ENV['PDFTK_PATH']),
            \escapeshellarg($tmpContent),
            \escapeshellarg($tmpBackground),
            \escapeshellarg($tmpResult)
        );

        \exec($command, $response, $codeStatus);

        if ($codeStatus !== 0) {
            throw new Exception(\sprintf('%s: %s', $codeStatus, \implode(\PHP_EOL, $response)), 400);
        }

        if (!\file_exists($tmpResult)) {
            throw new Exception('File [Output] not found', 400);
        }

        $encode = \base64_encode(\file_get_contents($tmpResult));

        \unlink($tmpBackground);
        \unlink($tmpContent);
        \unlink($tmpResult);

        return $encode;
    }
}
