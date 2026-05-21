<?php

declare(strict_types=1);

namespace Spoudazon\InkwellCms\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class HomeController
{
    public function __construct(
        private Environment $twig,
    ) {
    }

    public function __invoke(): Response
    {
        return new Response($this->twig->render('pages/home.html.twig', [
            'intro' => $this->siteIntro(),
            'posts' => $this->samplePosts(),
        ]));
    }

    private function siteIntro(): string
    {
        return "Inkwell is Alex Carter's notebook on building small, sharp "
            . "software — short essays on PHP, theming, and the decisions "
            . "that keep a codebase honest.";
    }

    /**
     * @return list<array{
     *     url: string,
     *     title: string,
     *     excerpt: string,
     *     date: string,
     *     read_time: int|null
     * }>
     */
    private function samplePosts(): array
    {
        return [
            [
                'url' => '/post/a-theme-system-that-stays-out-of-the-way',
                'title' => 'A Theme System That Stays Out of the Way',
                'excerpt' => 'A good theme lets authors change everything that matters and '
                    . 'break nothing that does not. Here is how Inkwell keeps templates, '
                    . 'assets, and configuration cleanly apart.',
                'date' => '2026-05-14',
                'read_time' => 7,
            ],
            [
                'url' => '/post/rendering-markdown-without-the-ceremony',
                'title' => 'Rendering Markdown Without the Ceremony',
                'excerpt' => 'Most Markdown pipelines collapse under their own '
                    . 'configuration. This one does the obvious thing and then gets out '
                    . 'of the way.',
                'date' => '2026-05-03',
                'read_time' => 5,
            ],
            [
                'url' => '/post/twig-inheritance-in-plain-language',
                'title' => 'Twig Inheritance in Plain Language',
                'excerpt' => 'Blocks, includes, and macros explained without the jargon, '
                    . 'with the trade-offs that decide which one to reach for.',
                'date' => '2026-04-19',
                'read_time' => 9,
            ],
            [
                'url' => '/post/notes-on-the-first-release',
                'title' => 'Notes on the First Release',
                'excerpt' => 'What shipped, what was deliberately left out, and the '
                    . 'smallest set of features that still felt honest to call a 1.0.',
                'date' => '2026-04-06',
                'read_time' => null,
            ],
        ];
    }
}
