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

class OwnerGroup extends Component
{   
    private $ownerGroupService;
    private $ownerService;
    private $userService;
    private $members;
    private $groups;
    private $user;
    private $owners;

    public function __construct () {
        $this->ownerService = new OwnerService (new OwnerRepository);
        $this->userService = new UserService (new UserRepository);
        $this->ownerGroupService = new OwnerGroupService (
            new OwnerGroupRepository,
            $this->ownerService,
            $this->userService
        );
        $this->user = Auth::user();
    }

    public function mount () {
        //IF THE TEAM DON'T EXISTS, THEN CREATE
        /*if (!count($this->ownerGroupService->listOwnerGroupByUserId($this->user->id)) > 0) {
            $this->ownerGroupService->createGroup ($this->user->id, $this->user->name . "'s Partners Group");
        }
        
        $this->members [0] = $this->ownerGroupService->getOwner($this->user->id);
        $this->group = $this->ownerGroupService->listOwnerGroupByUserId($this->user->id)[0];
        
        foreach ($this->ownerGroupService->listMyMembers($this->group->id) as $member) {
            $this->members [] = $this->userService->getUserById($member['user_id']);
        }*/

        $this->groups = $this->ownerGroupService->listOwnerGroupByUserId($this->user->id);

        foreach ($this->groups as $group) {
            $this->owners [$group->id] = $this->ownerGroupService->getGroupOwner ($group->id);
        }
    }   

    public function render()
    {
        return view('livewire.owner-group', [
            'members' => $this->members,
            'groups' => $this->groups,
            'owners' => $this->owners
        ]);
    }
}
