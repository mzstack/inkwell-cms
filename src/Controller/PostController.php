<?php

declare(strict_types=1);

namespace Spoudazon\InkwellCms\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class PostController
{
    public function __construct(
        private Environment $twig,
    ) {
    }

    public function __invoke(string $slug): Response
    {
        return new Response($this->twig->render('pages/post.html.twig', [
            'post' => $this->samplePost(),
            'author' => ['name' => 'Alex Carter'],
            'prev' => null,
            'next' => null,
        ]));
    }

    /**
     * Hard-coded placeholder post so the post view can be exercised before a
     * real content source exists. The {slug} route argument is ignored for
     * now -- every URL returns this same post. Replace once posts are real.
     *
     * `body` holds rendered HTML, the way a Markdown source file will once it
     * is run through a renderer -- not a structured block tree.
     *
     * @return array{
     *     url: string,
     *     title: string,
     *     date: string,
     *     updated: string|null,
     *     read_time: int|null,
     *     body: string
     * }
     */
    private function samplePost(): array
    {
        return [
            'url' => '/post/a-theme-system-that-stays-out-of-the-way',
            'title' => 'A Theme System That Stays Out of the Way',
            'date' => '2026-05-14',
            'updated' => null,
            'read_time' => 7,
            'body' => <<<'HTML'
                <p>Every theme starts with good intentions and ends as a tangle of
                overrides. Inkwell takes the boring way out: give a theme three
                clearly separated jobs and never let them bleed into one another.</p>

                <h2>Three jobs, three folders</h2>

                <p>A theme is just a directory. Templates render HTML, assets carry
                whatever the browser downloads, and a small config file declares the
                handful of values an author is actually allowed to change.</p>

                <ul>
                <li><strong>templates/</strong> — Twig files, and nothing but Twig files</li>
                <li><strong>assets/</strong> — CSS, fonts and images, published as-is</li>
                <li><strong>website config</strong> — the small surface an author edits</li>
                </ul>

                <p>Assets are mirrored into the public directory on first request and
                then left alone. There is no build step to forget and no stale bundle
                to chase down later:</p>

                <pre><code class="language-twig">{% include 'partials/header.html.twig' %}
                {% block content %}{% endblock %}
                {% include 'partials/footer.html.twig' %}</code></pre>

                <p>That single constraint is the whole design — everything else is just
                keeping the three folders honest.</p>
                HTML,
        ];
    }
}
