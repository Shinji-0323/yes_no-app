<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function normal()
    {
        return view('products.normal');
    }

    public function oily()
    {
        return view('products.oily');
    }

    public function dry()
    {
        return view('products.dry');
    }

    public function combo()
    {
        return view('products.combo');
    }
}
