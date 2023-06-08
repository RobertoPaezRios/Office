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
use App\Models\TeamType;
use App\Models\Sale;

class SearchTypes extends Component
{
    private $teamTypeHistoryService;
    private $teamTypeService;
    private $salesService;

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
    }

    public function update () {
        
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
        $types = TeamType::where('user_id', Auth::user()->id)
        ->where('name', 'like', '%'. $this->search .'%')
        ->paginate(5);

        $historics = [];

        //LIST THE HISTORICS PER TYPE
        foreach ($types as $type) {   
            $ids = [];
            $historicsIds = $this->teamTypeHistoryService->listTeamTypeHistoricsIds($type->id)->toArray();

            foreach ($historicsIds as $id) {
                $ids[] = $id['id'];
            }

            $historics[$type->id] = [
                'sales' => $this->salesService->countSalesByHistoricsIds ($ids),
                'teams' => count($this->teamTypeHistoryService->listTeamTypeHistoricsByTypeId($type->id))
            ];
        }

        return view('livewire.search-types', [
            'types' => $types,
            'sales' => $historics
        ]);
    }
}
