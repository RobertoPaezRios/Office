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
use App\Repositories\Sales\SalesRepository;
use App\Services\Sales\ListerService;
use App\Repositories\Sales\ListerRepository;
use App\Services\Sales\SellerService;
use App\Repositories\Sales\SellerRepository;
use App\Services\Sales\DetailService;
use App\Repositories\Sales\DetailRepository;
use App\Services\Sales\SalesService;

class OwnerGroup extends Component
{   
    private $ownerGroupService;
    private $ownerService;
    private $userService;
    private $teamService;
    private $salesService;
    private $listerService;
    private $sellerService;
    private $detailService;
    private $members;
    private $groups;
    private $user;
    private $owners;
    private $teams;
    private $sales;
    private $employees;

    public function __construct () {
        $this->ownerService = new OwnerService (new OwnerRepository);
        $this->userService = new UserService (new UserRepository);
        $this->teamService = new TeamService (
            new TeamRepository,
            new TeamTypeHistoryRepository
        );
        $this->listerService = new ListerService (new ListerRepository);
        $this->sellerService = new SellerService (new SellerRepository);
        $this->detailService = new DetailService (new DetailRepository);
        $this->salesService = new SalesService (
            new SalesRepository,
            $this->listerService,
            $this->sellerService,
            $this->detailService, 
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
            
            if (count($this->teams[$group->id]) > 0) {
                $this->sales[$group->id] = 0;
                foreach ($this->teams[$group->id] as $team) {
                    $this->sales [$group->id] += count($this->salesService->listSalesByTeamId ($team->id));
                    $this->employees [$group->id] = $this->teamService->listMembersByTeamId($team->id);
                }
            } else $this->sales [$group->id] = [];
        }
    }   

    public function render()
    {
        return view('livewire.owner-group', [
            'members' => $this->members,
            'groups' => $this->groups,
            'owners' => $this->owners,
            'teams' => $this->teams,
            'sales' => $this->sales,
            'employees' => $this->employees
        ]);
    }
}
