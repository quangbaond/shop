<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View
    {
        $title = __('Dashboard');
        return view('admin.home', compact('title'));
    }
}
