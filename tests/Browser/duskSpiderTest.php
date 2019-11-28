<?php

namespace Tests\Browser;

use App\Page;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class duskSpiderTest extends DuskTestCase
{

    protected static $domain = '127.0.0.1';
    protected static $startUrl = 'http://127.0.0.1:8000/';

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
    }
    /** @test */
    public function urlSpider()
    {
        $startingLink = Page::create([
            'url' => self::$startUrl,
            'isCrawled' => false,
        ]);
        
        $this->browse(function (Browser $browser) use ($startingLink) {
            $this->getLinks($browser, $startingLink);
        });
    }
    protected function getLinks(Browser $browser, $currentUrl)
    {
        $this->processCurrentUrl($browser, $currentUrl);
        try {
            foreach (Page::where('isCrawled', false)->get() as $link) {
                $this->getLinks($browser, $link);
            }
        } catch (Exception $e) { }
    }
    protected function processCurrentUrl(Browser $browser, $currentUrl)
    {
        //Check if already crawled
        if (Page::where('url', $currentUrl->url)->first()->isCrawled == true)
            return;

        //Visit URL
        $user = factory('App\User')->create();
        $browser->loginAs($user)
                ->visit($currentUrl->url)
                ->assertTitle($browser->driver->getTitle());

        //Get Links and Save to DB if Valid
        $linkElements = $browser->driver->findElements(WebDriverBy::tagName('a'));

        foreach ($linkElements as $element) {
            $href = $element->getAttribute('href');
            $href = $this->trimUrl($href);
            if ($this->isValidUrl($href)) {
                //var_dump($href);
                Page::create([
                    'url' => $href,
                    'isCrawled' => false,
                ]);
            }
        }
        //Update current url status to crawled
        $currentUrl->isCrawled = true;
        $currentUrl->status  = $this->getHttpStatus($currentUrl->url);
        $currentUrl->title = $browser->driver->getTitle();
        $currentUrl->save();
    }
    protected function isValidUrl($url)
    {
        $parsed_url = parse_url($url);
        if (isset($parsed_url['host'])) {
            if (strpos($parsed_url['host'], self::$domain) !== false && !Page::where('url', $url)->exists()) {
                return true;
            }
        }
        return false;
    }
    protected function trimUrl($url)
    {
        $url = strtok($url, '#');
        $url = rtrim($url, "/");
        return $url;
    }
    protected function getHttpStatus($url)
    {
        $headers = get_headers($url, 1);
        return intval(substr($headers[0], 9, 3));
    }
}
