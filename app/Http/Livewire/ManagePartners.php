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

class ManagePartners extends Component
{
    private $ownerGroupService;
    private $ownerService;
    private $userService;
    private $teamService;
    public $uuid;
    private $owner;
    private $partners;
    public $deleteId;

    public function mount (
        $uuid
    ) {
        $this->ownerService = new OwnerService (
            new OwnerRepository
        );

        $this->userService = new UserService (
            new UserRepository
        );

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

        $this->uuid = $uuid;
    }

    public function getDeleteId($id) {
        $this->deleteId = $id;
        $this->mount($this->uuid);
        
        if (!is_null($this->ownerService->getOwner(intval($id)))) {
            $this->uuid = $this->ownerService->getOwner($id)->owner_group->uuid;   
        }
    }

    public function destroy () {
        $this->mount($this->uuid);
        if (!$this->ownerService->destroy($this->deleteId)) {
            return redirect()
            ->back()
            ->with('status', 'Something went wrong while removing the partner')
            ->with('style', 'danger');
        }
    }

    public function render() {
        $group = $this->ownerGroupService->getGroupByUuid($this->uuid);
        
        if (is_null($group)) {
            return redirect()
            ->back()
            ->with('status', 'Community not found!')
            ->with('style', 'danger');
        }

        $this->owner = $group->owner;
        $this->partners = $group->partners;

        if (count($this->partners) > 0) {
            foreach ($this->partners as $partner) {
                $users[$partner->user_id] = $this->userService->getUserById($partner->user_id);
            }
        } else $users = [];

        return view('livewire.manage-partners', [
            'owner' => $this->owner,
            'links' => $this->partners,
            'partners' => $users,
            'group' => $group,
            'user' => Auth::user()
        ]);
    }
}
