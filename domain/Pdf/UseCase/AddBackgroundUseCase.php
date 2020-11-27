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
use LogicException;

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
        if ($request->encode !== 'base64') {
            throw new LogicException(sprintf('Used encode base64, %s is not supported', $request->encode));
        }

        if (empty($request->background) || empty($request->content)) {
            throw new LogicException('Background and content are required');
        }

        return new BackgroundResponse($this->getRepository()->background($request));
    }
}