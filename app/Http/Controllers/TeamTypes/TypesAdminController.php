<?php

namespace App\Http\Controllers\TeamTypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TypesAdminController extends Controller
{
    public function index () {
        return view('types-admin.editor');
    }
}
