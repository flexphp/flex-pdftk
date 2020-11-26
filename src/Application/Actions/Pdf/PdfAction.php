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

use App\Application\Actions\Action;
use Domain\Pdf\PdfGateway;
use Psr\Log\LoggerInterface;

abstract class PdfAction extends Action
{
    /**
     * @var PdfGateway
     */
    protected $pdfGateway;

    public function __construct(LoggerInterface $logger, PdfGateway $pdfGateway)
    {
        parent::__construct($logger);

        $this->pdfGateway = $pdfGateway;
    }
}
