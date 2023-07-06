<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Team\TeamTypeService;
use App\Repositories\Team\TeamTypeRepository;
use App\Services\Team\TeamTypeHistoryService;
use App\Repositories\Team\TeamTypeHistoryRepository;
use App\Services\Sales\SalesService;
use App\Repositories\Sales\SalesRepository;
use App\Services\Sales\ListerService;
use App\Repositories\Sales\ListerRepository;
use App\Services\Sales\SellerService;
use App\Repositories\Sales\SellerRepository;
use App\Services\Sales\DetailService;
use App\Repositories\Sales\DetailRepository;
use App\Services\Owners\OwnerGroupService;
use App\Repositories\Owners\OwnerGroupRepository;
use App\Services\Owners\OwnerService;
use App\Repositories\Owners\OwnerRepository;
use App\Services\User\UserService;
use App\Repositories\User\UserRepository;
use App\Services\Team\TeamService;
use App\Repositories\Team\TeamRepository;
use App\Models\TeamType;
use App\Models\Sale;

class SearchTypes extends Component
{
    private $teamTypeHistoryService;
    private $teamTypeService;
    private $salesService;
    private $ownerGroupService;
    private $ownerService;
    private $userService;
    private $teamService;

    public $search;
    public $deleteId = '';

    public function __construct () {
        $this->teamTypeHistoryService = new TeamTypeHistoryService (new TeamTypeHistoryRepository);

        $this->teamTypeService = new TeamTypeService (new TeamTypeRepository);

        $this->salesService = new SalesService (
            new SalesRepository,
            new ListerService (new ListerRepository),
            new SellerService (new SellerRepository),
            new DetailService (new DetailRepository)
        );

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
    }

    public function setDeleteId ($id) {
        $this->deleteId = $id;
    }

    public function destroy () {
        //CHECK IF ANY TEAM IS LINKED WITH THIS TEAM TYPE
        if (count($this->teamTypeHistoryService->listTeamTypeHistoricsByTypeId($this->deleteId)->toArray()) == 0) {  
            $res = $this->teamTypeService->destroyType($this->deleteId);
        } 
    }

    public function render()
    {
        //LIST THE CIRCLES 
        $circles = $this->ownerGroupService->listOwnerGroupByUserId(Auth::user()->id);
        $links = $this->ownerService->listGroupsByMemberId(Auth::user()->id);
        
        if (count($links) > 0) {
            foreach ($links as $link) {
                $groups [] = $this->ownerGroupService->getGroup($link->group_id);
            }

            foreach ($groups as $group) {
                $total [$group->id] = $group;
            }
        }

        foreach ($circles as $circle) {
            $total[$circle->id] = $circle;
        }

        if (isset($total)) {
            foreach ($total as $community) {
                $types[$community->id] = TeamType::where('group_id', $community->id)
                ->where('name', 'like', '%' . $this->search . '%')
                ->get();
            }
        } else {
            $types = [];
        }

        /*$types = TeamType::where('user_id', Auth::user()->id)
        ->where('name', 'like', '%'. $this->search .'%')
        ->paginate(5);*/

        $historics = [];
        $communities = [];

        //LIST THE HISTORICS PER TYPE
        foreach ($types as $community) {
            foreach ($community as $type) {
                $ids = [];
                $historicsIds = $this->teamTypeHistoryService->listTeamTypeHistoricsIds($type->id)->toArray();
                $communities[$type->id] = $this->ownerGroupService->getGroup($type->group_id);

                foreach ($historicsIds as $id) {
                    $ids[] = $id['id'];
                }

                $historics[$type->id] = [
                    'sales' => $this->salesService->countSalesByHistoricsIds ($ids),
                    'teams' => count($this->teamTypeHistoryService->listTeamTypeHistoricsByTypeId($type->id))
                ];
            }
        }

        return view('livewire.search-types', [
            'types' => $types,
            'sales' => $historics,
            'communities' => $communities
        ]);
    }
}
