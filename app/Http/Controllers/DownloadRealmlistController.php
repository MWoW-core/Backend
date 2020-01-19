<?php

namespace App\Http\Controllers;

use App\Realmlist;
use Illuminate\Support\Facades\Response;

class DownloadRealmlistController extends Controller
{
    public function __invoke(?Realmlist $realmlist)
    {
        $realmlist = $realmlist->exists ? $realmlist : Realmlist::query()->firstOrFail();

        $this->authorize('download', $realmlist);

        return Response::streamDownload(static function () use ($realmlist) {
            echo "SET REALMLIST {$realmlist->address}";
        }, 'realmlist.wtf');
    }
}
