<?php

namespace App\Http\Controllers\TeamTypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\Team\TeamService;

class TypesAdminController extends Controller
{
    private $teamService;

    public function __construct (
        TeamService $teamService
    ) {
        $this->teamService = $teamService;
    }

    public function index () {
        $team = $this->teamService->getTeam(Auth::user()->current_team_id);

        if (is_null($team)) {
            return redirect()
            ->route('dashboard')
            ->with('status', 'Team not found!')
            ->with('style', 'danger');
        }

        if (!$this->teamService->isPersonal($team)) {
            return redirect ()
            ->route('dashboard')
            ->with('status', 'You only can access this page from your personal page')
            ->with('style', 'danger');
        }

        return view('types-admin.editor');
    }
}
