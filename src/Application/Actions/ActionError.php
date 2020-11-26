<?php
declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Application\Actions;

use JsonSerializable;

class ActionError implements JsonSerializable
{
    public const BAD_REQUEST = 'BAD_REQUEST';

    public const INSUFFICIENT_PRIVILEGES = 'INSUFFICIENT_PRIVILEGES';

    public const NOT_ALLOWED = 'NOT_ALLOWED';

    public const NOT_IMPLEMENTED = 'NOT_IMPLEMENTED';

    public const RESOURCE_NOT_FOUND = 'RESOURCE_NOT_FOUND';

    public const SERVER_ERROR = 'SERVER_ERROR';

    public const UNAUTHENTICATED = 'UNAUTHENTICATED';

    public const VALIDATION_ERROR = 'VALIDATION_ERROR';

    public const VERIFICATION_ERROR = 'VERIFICATION_ERROR';

    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    public function __construct(int $code, string $type, ?string $description)
    {
        $this->code = $code;
        $this->type = $type;
        $this->description = $description;
    }

    public function code(): int
    {
        return $this->code;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function jsonSerialize()
    {
        return $this->jsonApi();
    }

    private function jsonApi(): array
    {
        return [
            'status' => $this->code,
            'title' => $this->type,
            'detail' => $this->description,
        ];
    }
}
