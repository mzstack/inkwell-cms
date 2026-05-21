<?php

declare(strict_types=1);

namespace Spoudazon\InkwellCms\Tests\Integration\Controller;

use Spoudazon\InkwellCms\Tests\Integration\WebTestCase;

final class HomeControllerTest extends WebTestCase
{
    public function testHomeRouteRendersHomePage(): void
    {
        $response = $this->request('GET', '/');

        self::assertSame(200, $response->getStatusCode());
        // The post-list container is rendered only by the home page's content
        // block, so its presence proves routing, the controller and Twig all ran.
        self::assertStringContainsString(
            'class="post-list"',
            (string) $response->getContent(),
        );
    }
}
