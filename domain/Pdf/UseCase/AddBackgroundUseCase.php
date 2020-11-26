<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domain\Pdf\UseCase;

use Domain\Pdf\Request\BackgroundRequest;
use Domain\Pdf\Response\BackgroundResponse;
use FlexPHP\UseCases\UseCase;

/**
 * @method \Domain\Pdf\PdfRepository getRepository
 */
final class AddBackgroundUseCase extends UseCase
{
    /**
     * @param BackgroundRequest $request
     * @return BackgroundResponse
     */
    public function execute($request)
    {
        return new BackgroundResponse($this->getRepository()->background($request));
    }
}