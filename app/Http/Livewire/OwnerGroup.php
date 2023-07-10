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
    private $partners;
    private $colors;
    private $links;
    public $deleteId;

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
        $groups = $this->ownerGroupService->listOwnerGroupByUserId($this->user->id);
        $links = $this->ownerService->listGroupsByMemberId($this->user->id);
        
        foreach ($links as $link) {
            $this->links[$link->group_id] = $this->ownerGroupService->getGroup($link->group_id);
        }

        foreach ($groups as $group) {
            $this->owners [$group->id] = $this->ownerGroupService->getGroupOwner ($group->id);
            $this->teams [$group->id] = $this->ownerGroupService->listTeamsByGroupId ($group->id);
            $this->colors [$group->id] = $this->ownerGroupService->getColorByGroupId ($group->id);
            $this->partners[$group->id] = $this->ownerGroupService->listMyMembers($group->id);

            if (count($this->teams[$group->id]) > 0) {
                foreach ($this->teams[$group->id] as $team) {
                    $this->employees [$group->id] = count($this->teamService->listMembersByTeamId($team->id));
                }
            } else $this->employees [$group->id] = 0;
        }

        foreach ($groups as $group) {
            $this->groups [$group->id] = $group;
        }

        if ($this->links) {
            foreach ($this->links as $link) {
                $this->groups [$link->id] = $link;
                $this->colors [$link->id] = $link->color;
                $this->owners [$link->id] = $link->owner;
                $this->teams [$link->id] = $this->ownerGroupService->listTeamsByGroupId ($link->id);
                
                if (count($this->teams[$link->id]) > 0) {
                    foreach ($this->teams[$link->id] as $team) {
                        $this->employees [$link->id] = count($this->teamService->listMembersByTeamId($team->id));
                    }
                } else $this->employees [$link->id] = 0;            
            }
        }
    }   

    public function setDeleteUuid ($uuid) {
        if (!is_null($this->ownerGroupService->getGroupByUuid($uuid))) {
            if (count($this->ownerGroupService->listBelongingCommunities(Auth::user())) > 0) {
                $cont = 0;

                foreach ($this->ownerGroupService->listBelongingCommunities(Auth::user()) as $community) {
                    if ($community->uuid === $uuid) {
                        $this->deleteId = $community->id;
                        break;
                    }
                    $cont+=1;
                }  

                if ($cont >= count($this->ownerGroupService->listBelongingCommunities(Auth::user()))) {
                    return redirect()
                    ->back()
                    ->with('status', '0 communities found!')
                    ->with('style', 'danger');
                }
            } else {
                return redirect()
                ->back()
                ->with('status', '0 communities found!')
                ->with('style', 'danger');
            }
        } else {
            return redirect()
            ->back()
            ->with('status', '0 communities found!')
            ->with('style', 'danger');
        }
    }

    public function destroy () {
        if (!is_null($this->deleteId)) {
            $communities = $this->ownerGroupService->listBelongingCommunities(Auth::user());

            if ($communities) {
                $cont = 0;
                foreach ($communities as $community) {
                    if ($community->id === $this->deleteId && count($community->teams) == 0 && count($this->ownerGroupService->listMyMembers($community->id)) == 0) {
                        break;
                    }
                    
                    $cont += 1;
                }
                
                if ($cont >= count($communities)) {
                    return redirect()
                    ->back()
                    ->with('status', '0 communities found!')
                    ->with('style', 'danger');
                }

                if ($this->ownerGroupService->destroyGroup($this->deleteId)) {
                    return redirect()
                    ->back()
                    ->with('status', 'Group Deleted Successfully!')
                    ->with('style', 'success');
                } else {
                    return redirect()
                    ->back()
                    ->with('status', 'Something ocurred while deleting the group!')
                    ->with('style', 'danger');   
                }
            } else {
                return redirect()
                ->back()
                ->with('status', '0 communities found!')
                ->with('style', 'danger');
            }
        } else {
            return redirect()
            ->back()
            ->with('status', '0 communities found!')
            ->with('style', 'danger');
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
            'colors' => $this->colors,
            'partners' => $this->partners
        ]);
    }
}
