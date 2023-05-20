<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    public function index()
    {
        return view('front.user.package.index');
    }
}
