<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Application\Actions\Pdf;

use App\Application\Actions\ActionError;
use App\Application\Actions\ActionPayload;
use Tests\TestCase;

class BackgroundActionTest extends TestCase
{
    public function _testActionError(): void
    {
        $app = $this->getAppInstance();

        $request = $this->createRequest('GET', '/background');
        $response = $app->handle($request);
        dd($response, __FILE__);

        $payload = (string)$response->getBody();
        $expectedPayload = new ActionPayload(500, [
            'json' => [
                'version' => '1.0',
            ],
            'errors' => [
                [
                    'status' => 500,
                    'title' => ActionError::SERVER_ERROR,
                    'Test error response',
                ],
            ],
        ]);
        $serializedPayload = \json_encode($expectedPayload, \JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    public function testActionOk(): void
    {
        $app = $this->getAppInstance();

        $request = $this->createRequest('POST', '/background');
        $request->getBody()->write(\json_encode([
            'auth' => [
                'username' => 'test',
                'password' => \hash('sha256', 'test'),
            ],
            'data' => [
                'type' => 'pdf',
                'id' => ($id = \time()),
                'attributes' => [
                    'background' => \base64_encode(\file_get_contents(__DIR__ . '/../../../Resource/watermark.pdf')),
                    'content' => \base64_encode(\file_get_contents(__DIR__ . '/../../../Resource/content.pdf')),
                    'encode' => 'base64',
                ],
            ],
        ]));

        $response = $app->handle($request);

        $payload = (string)$response->getBody();
        $expectedPayload = new ActionPayload(200, [
            'type' => 'pdf',
            'id' => $id,
            'attributes' => [
                'content' => \base64_encode(\file_get_contents(__DIR__ . '/../../../Resource/result.pdf')),
                'encode' => 'base64',
            ],
        ]);
        $serializedPayload = \json_encode($expectedPayload, \JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
