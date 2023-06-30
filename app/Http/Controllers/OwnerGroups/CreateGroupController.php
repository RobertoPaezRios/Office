<?php

namespace App\Http\Controllers\OwnerGroups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\User\UserService;
use App\Services\Team\TeamService;
use App\Services\Owners\OwnerGroupService;

class CreateGroupController extends Controller
{
    private $userService;
    private $teamService;
    private $ownerGroupService;
    private $user;
    private $team;

    public function __construct (
        UserService $userService,
        TeamService $teamService,
        OwnerGroupService $ownerGroupService
    ) {
        $this->userService = $userService;
        $this->teamService = $teamService;
        $this->ownerGroupService = $ownerGroupService;
    }
    
    public function create () {
        $this->user = $this->userService->getUserById (Auth::user()->id);
        $this->team = $this->teamService->getTeam ($this->user->current_team_id);

        if ($this->team) {

            if ($this->teamService->isPersonal ($this->team)) 
                return view('owners-group.create-group');
        }

        return redirect()->route('dashboard');
    }

    public function store (Request $req) {
        $this->user = $this->userService->getUserById (Auth::user()->id);
        $this->team = $this->teamService->getTeam ($this->user->current_team_id);

        $req->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        if ($this->ownerGroupService->checkIfNameIsAvailable($req['name'], $this->user->id)) {
            if ($this->ownerGroupService->createGroup ($this->user->id, $req['name'])) {
                return redirect()
                ->route('partners-admin')
                ->with('status', 'Group ' . $req['name'] . ' created successfully!')
                ->with('style', 'success');
            } else {
                return redirect()
                ->route('partners-admin')
                ->with('status', 'Something ocurred while creating the ' . $req['name'] . ' group')
                ->with('style', 'danger');
            }
        } else {
            return redirect()->back();
        }
    }
}
