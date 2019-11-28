<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory('App\User')->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/export/user')
                ->assertSee('Action');
                
        });
    }
    protected function getHttpStatus($url)
    {
        $headers = get_headers($url, 1);
        return intval(substr($headers[0], 9, 3));
    }
}
