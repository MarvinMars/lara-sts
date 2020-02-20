<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Services\Stats\Tables\AbstractTable;
use Artisan;

class PurgeCacheController extends Controller
{
    public function index()
    {
        \Cache::tags(AbstractTable::CACHE_TAGS)->clear();
        Artisan::call('page-cache:clear');

        Alert::success('Stats Published')->flash();

        return redirect(request()->headers->get('referer'));
    }
}