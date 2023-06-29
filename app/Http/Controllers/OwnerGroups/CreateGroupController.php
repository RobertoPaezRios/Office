<?php

namespace App\Http\Controllers\OwnerGroups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\User\UserService;
use App\Services\Team\TeamService;

class CreateGroupController extends Controller
{
    private $userService;
    private $teamService;
    private $user;
    private $team;

    public function __construct (
        UserService $userService,
        TeamService $teamService,
    ) {
        $this->userService = $userService;
        $this->teamService = $teamService;
    }
    
    public function create () {
        $this->user = $this->userService->getUserById (Auth::user()->id);
        $this->team = $this->teamService->getTeam ($this->user->current_team_id);
        if ($this->teamService->isPersonal ($this->team)) 
            return view('owners-group.create-group');

        return redirect()->route('dashboard');
    }
}