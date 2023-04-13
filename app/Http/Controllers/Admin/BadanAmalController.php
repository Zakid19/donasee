<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BadanAmalController extends Controller
{
    public function create()
    {
        return view('admin.badan-amal.create');
    }

}
