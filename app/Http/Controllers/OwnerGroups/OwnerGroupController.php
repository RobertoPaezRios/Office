<?php

namespace App\Http\Controllers\OwnerGroups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\User\UserService;
use App\Services\Team\TeamService;

class OwnerGroupController extends Controller
{
    private $userService;
    private $teamService;
    private $user;
    private $team;

    public function __construct (
        UserService $userService,
        TeamService $teamService
    ) {
        $this->userService = $userService;
        $this->teamService = $teamService;
    }

    public function create () {
        $team = $this->teamService->getTeam(Auth::user()->current_team_id);

        if (is_null($team)) {
            return redirect()
            ->route('dashboard')
            ->with('status', 'Team not found!')
            ->with('style', 'danger');
        }

        $this->user = $this->userService->getUserById(Auth::user()->id);
        $this->team = $this->teamService->getTeam($this->user->current_team_id);

        if ($this->team) {
            if ($this->teamService->isPersonal ($this->team))
                return view('owners-group.owner-group');
        } 
        
        return redirect()->route('dashboard');
    }
}
