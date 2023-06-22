<?php

namespace App\Http\Livewire;

use Livewire\Component;

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

    public function __construct () {
        $this->ownerService = new OwnerService (new OwnerRepository);
        $this->ownerGroupService = new OwnerGroupService (
            new OwnerGroupRepository,
            $this->ownerService
        );
        $this->userService = new UserService (new UserRepository);
    }

    public function mount () {
        foreach ($this->ownerGroupService->listMyMembers(1) as $member) {
            $this->members [] = $this->userService->getUserById($member['user_id']);
        }
    }   

    public function render()
    {
        return view('livewire.owner-group', [
            'members' => $this->members
        ]);
    }
}
