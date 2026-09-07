<?php

namespace App\Console\Commands;

use App\Models\BlogPost;
use App\Models\Hotel;
use App\Models\Itinerary;
use App\Models\Vehicle;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * php artisan sitemap:generate
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * @var string
     */
    protected $description = 'Regenerate public/sitemap.xml from the app\'s real routes plus published tours, vehicles, hotels, and blog posts.';

    public function handle(): int
    {
        $urls = [];

        // ── Static marketing / content pages ──
        $static = [
            ['/',               '1.0', 'weekly'],
            ['/about',          '0.7', 'monthly'],
            ['/our-services',   '0.9', 'weekly'],
            ['/transfer',       '0.7', 'monthly'],
            ['/events',         '0.7', 'monthly'],
            ['/air-ticketing',  '0.7', 'monthly'],
            ['/hotel-booking',  '0.7', 'monthly'],
            ['/tours-booking',  '0.6', 'monthly'],
            ['/contact',        '0.5', 'yearly'],
            ['/cars',           '0.8', 'weekly'],
            ['/tours',          '0.8', 'weekly'],
            ['/blog',           '0.6', 'weekly'],
            ['/privacy-policy', '0.2', 'yearly'],
            ['/terms-conditions', '0.2', 'yearly'],
        ];

        foreach ($static as [$path, $priority, $freq]) {
            $urls[] = $this->urlEntry(url($path), $priority, $freq);
        }

        // ── Dynamic content pages ──
        foreach (Itinerary::query()->select('id', 'updated_at')->get() as $tour) {
            $urls[] = $this->urlEntry(url('/tour/' . $tour->id), '0.7', 'monthly', $tour->updated_at);
        }

        foreach (Vehicle::query()->where('approved', true)->where('sold', false)->select('id', 'updated_at')->get() as $vehicle) {
            $urls[] = $this->urlEntry(url('/car/' . $vehicle->id), '0.6', 'weekly', $vehicle->updated_at);
        }

        foreach (Hotel::query()->where('available', true)->select('id', 'updated_at')->get() as $hotel) {
            $urls[] = $this->urlEntry(url('/hotel/' . $hotel->id), '0.6', 'weekly', $hotel->updated_at);
        }

        foreach (BlogPost::query()->where('published', true)->select('slug', 'updated_at')->get() as $post) {
            $urls[] = $this->urlEntry(url('/blog/' . $post->slug), '0.6', 'monthly', $post->updated_at);
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
            . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n"
            . implode('', $urls)
            . '</urlset>' . "\n";

        file_put_contents(public_path('sitemap.xml'), $xml);

        $this->info('sitemap.xml written with ' . count($urls) . ' URLs.');

        return self::SUCCESS;
    }

    private function urlEntry(string $loc, string $priority, string $changefreq, $lastmod = null): string
    {
        $lastmod = $lastmod ? $lastmod->format('Y-m-d') : now()->format('Y-m-d');

        return "    <url>\n"
            . "        <loc>{$loc}</loc>\n"
            . "        <lastmod>{$lastmod}</lastmod>\n"
            . "        <changefreq>{$changefreq}</changefreq>\n"
            . "        <priority>{$priority}</priority>\n"
            . "    </url>\n";
    }
}
