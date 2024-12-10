<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function normal(): View
    {
        return view('products.normal');
    }

    public function oily(): View
    {
        return view('products.oily');
    }

    public function dry(): View
    {
        return view('products.dry');
    }

    public function combo(): View
    {
        return view('products.combo');
    }
}
