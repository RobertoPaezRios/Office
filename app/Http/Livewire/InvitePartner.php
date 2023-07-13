<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Services\User\UserService;
use App\Repositories\User\UserRepository;
use App\Services\Owners\OwnerService;
use App\Repositories\Owners\OwnerRepository;
use App\Services\Owners\OwnerGroupService;
use App\Repositories\Owners\OwnerGroupRepository;
use App\Services\Team\TeamService;
use App\Repositories\Team\TeamRepository;
use App\Repositories\Team\TeamTypeRepository;
use App\Repositories\Team\TeamTypeHistoryRepository;
use App\Services\Mails\GroupInvitationService;
use App\Repositories\Mails\GroupInvitationRepository;

class InvitePartner extends Component
{
    private $userService;
    private $ownerService;
    private $ownerGroupService;
    private $teamService;
    private $groupInvitationService;
    public $uuid;
    public $email;

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

        $this->groupInvitationService = new GroupInvitationService (
            new GroupInvitationRepository
        );

        $this->uuid = $uuid;
    }

    public function send() {
        $this->mount($this->uuid);
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()
            ->route('update-community', $this->uuid)
            ->with('status', 'Incorrect email')
            ->with('style', 'danger');
        } 

        if (Auth::user()->email == $this->email) {
            return redirect()
            ->route('update-community', $this->uuid)
            ->with('status', 'This email is already in the community')
            ->with('style', 'danger');
        }

        $group = $this->ownerGroupService->getGroupByUuid($this->uuid);
        $members = $this->ownerService->listMembersByGroupId($group->id);

        if (count($members) > 0) {
            foreach ($members as $member) {
                if ($this->userService->getUserById($member->user_id)->email == $this->email) {
                    return redirect()
                    ->route('update-community', $this->uuid)
                    ->with('status', 'This email is already in the community')
                    ->with('style', 'danger');
                }    
            }
        }
        
        //CREATING THE REGISTER
        $data = [
            'group_id' => $group->id,
            'email' => $this->email,
            'token' => hash('sha256', $group->id . $this->email . time())
        ];

        if (!$this->groupInvitationService->createInvitation ($data)) {
            return redirect()
            ->route('update-community', $this->uuid)
            ->with('status', 'Somethings went wrong while creating the invitation')
            ->with('style', 'danger');
        }

        //SEND EMAIL
        

        return redirect()
        ->route('update-community', $this->uuid)
        ->with('status', $this->email . ' has received an invitation to his email successfully')
        ->with('style', 'success');
    }

    public function cancel ($token) {
        $this->mount($this->uuid);

        if (!is_null($this->groupInvitationService->getInvitation($token))) {
            if (!$this->groupInvitationService->deleteInvitation($token)) {
                return redirect()
                ->route('update-community', $this->uuid)
                ->with('status', 'Something ocurred while deleting the invitation')
                ->with('style', 'danger');
            }
        } else {
            return redirect()
            ->route('update-community', $this->uuid)
            ->with('status', 'Invitation not found!')
            ->with('style', 'danger');
        }
    }

    public function render()
    {
        $this->mount($this->uuid);

        $group = $this->ownerGroupService->getGroupByUuid($this->uuid);
        $invitations = $this->groupInvitationService->listInvitationsByGroupId($group->id);

        return view('livewire.invite-partner', [
            'invitations' => $invitations  
        ]);
    }
}
