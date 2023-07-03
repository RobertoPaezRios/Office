<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Services\Owners\OwnerGroupService;
use App\Repositories\Owners\OwnerGroupRepository;
use App\Services\Owners\OwnerService;
use App\Repositories\Owners\OwnerRepository;
use App\Services\User\UserService;
use App\Repositories\User\UserRepository;
use App\Services\Team\TeamService;
use App\Repositories\Team\TeamRepository;
use App\Repositories\Team\TeamTypeHistoryRepository;

class OwnerGroup extends Component
{   
    private $ownerGroupService;
    private $ownerService;
    private $userService;
    private $teamService;
    private $members;
    private $groups;
    private $user;
    private $owners;
    private $teams;
    private $sales;
    private $employees;
    private $colors;

    public function __construct () {
        $this->ownerService = new OwnerService (new OwnerRepository);
        $this->userService = new UserService (new UserRepository);
        $this->teamService = new TeamService (
            new TeamRepository,
            new TeamTypeHistoryRepository
        );
        $this->ownerGroupService = new OwnerGroupService (
            new OwnerGroupRepository,
            $this->ownerService,
            $this->userService,
            $this->teamService
        );
        $this->user = Auth::user();
    }

    public function mount () {
        $this->groups = $this->ownerGroupService->listOwnerGroupByUserId($this->user->id);

        foreach ($this->groups as $group) {
            $this->owners [$group->id] = $this->ownerGroupService->getGroupOwner ($group->id);
            $this->teams [$group->id] = $this->ownerGroupService->listTeamsByGroupId ($group->id);
            $this->colors [$group->id] = $this->ownerGroupService->getColorByGroupId ($group->id);

            if (count($this->teams[$group->id]) > 0) {
                foreach ($this->teams[$group->id] as $team) {
                    $this->employees [$group->id] = count($this->teamService->listMembersByTeamId($team->id));
                }
            } else $this->employees [$group->id] = 0;
        }
    }   

    public function render()
    {
        $this->mount();

        return view('livewire.owner-group', [
            'members' => $this->members,
            'groups' => $this->groups,
            'owners' => $this->owners,
            'teams' => $this->teams,
            'employees' => $this->employees,
            'colors' => $this->colors
        ]);
    }
}
