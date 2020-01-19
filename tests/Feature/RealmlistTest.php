<?php

namespace Tests\Feature;

use App\Http\Controllers\RealmlistController;
use App\Realmlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RealmlistTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Realmlist::disableSearchSyncing();

        Realmlist::query()->truncate();
    }

    public function testCanDownloadARealmlistFile()
    {
        factory(Realmlist::class)->create(['address' => 'login.mwow.host']);

        $response = $this->get("/download-realmlist");
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'text/html; charset=UTF-8');
        $response->assertHeader('content-disposition', 'attachment; filename=realmlist.wtf');

        self::assertEquals('SET REALMLIST login.mwow.host', $response->streamedContent());
    }

    public function testItDownloadsASpecificRealmlistIfGiven()
    {
        factory(Realmlist::class)->create(['address' => 'login.mwow.host']);
        $retail = factory(Realmlist::class)->create(['address' => 'logon.worldofwarcraft.com']);

        $response = $this->get("/download-realmlist/{$retail->id}");
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'text/html; charset=UTF-8');
        $response->assertHeader('content-disposition', 'attachment; filename=realmlist.wtf');

        self::assertEquals('SET REALMLIST logon.worldofwarcraft.com', $response->streamedContent());
    }
}
