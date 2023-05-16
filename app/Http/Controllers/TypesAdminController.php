<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\Team\TeamTypeService;

class TypesAdminController extends Controller
{
    private $teamTypeService;

    public function __construct (TeamTypeService $teamTypeService) {
        $this->teamTypeService = $teamTypeService;
    }

    public function index () {
        return view('types-admin.editor');
    }
}
