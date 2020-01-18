<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsCategoryIndex extends Controller
{
    public function __invoke(Request $request)
    {
        return News::query()->distinct()->pluck('category');
    }
}
