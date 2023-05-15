<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypesAdminController extends Controller
{
    public function index () {
        return view('types-admin.editor');
    }
}
