<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'servicesCount' => Service::count(),
            'brandsCount' => Brand::count(),
            'categoriesCount' => Category::count(),
        ]);
    }
}
