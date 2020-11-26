<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Application\Actions\Pdf;

use Domain\Pdf\PdfRepository;
use Domain\Pdf\Request\BackgroundRequest;
use Domain\Pdf\UseCase\AddBackgroundUseCase;
use Psr\Http\Message\ResponseInterface as Response;

class BackgroundAction extends PdfAction
{
    protected function action(): Response
    {
        $body = json_decode((string)$this->request->getBody(), true) ?? [];

        $request = new BackgroundRequest($body);

        $useCase = new AddBackgroundUseCase(new PdfRepository($this->pdfGateway));

        $response = $useCase->execute($request);

        return $this->respondWithData([
            'type' => $request->type,
            'id' => $request->id,
            'attributes' => [
                'content' => $response->content,
                'encode' => $response->encode,
            ],
        ]);
    }
}
