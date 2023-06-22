<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Services\Sales\SalesService;
use App\Repositories\Sales\SalesRepository;
use App\Services\Sales\ListerService;
use App\Repositories\Sales\ListerRepository;
use App\Services\Sales\SellerService;
use App\Repositories\Sales\SellerRepository;
use App\Services\Sales\DetailService;
use App\Repositories\Sales\DetailRepository;
use App\Services\Levels\LevelService;
use App\Repositories\Levels\LevelRepository;

use Illuminate\Support\Facades\Auth;  

class FilterOperations extends Component
{
    private $salesService;
    private $detailService;
    private $sellerService;
    private $levelService;
    private $listerService;
    private $user;
    private $time;
    public $sales;
    public $details;
    public $sellers;
    public $listers;
    public $collaborators;
    public $level;
    public $collaboratorsAmount;
    public $income;

    public function __construct () {
        $this->salesService = new SalesService (
            new SalesRepository,
            new ListerService (new ListerRepository),
            new SellerService (new SellerRepository),
            new DetailService (new DetailRepository)
        );

        $this->detailService = new DetailService (
            new DetailRepository
        );

        $this->sellerService = new SellerService (
            new SellerRepository
        );

        $this->listerService = new ListerService (
            new ListerRepository
        );

        $this->levelService = new LevelService (
            new LevelRepository
        );

        $this->user = Auth::user();
        $this->level = $this->levelService->getLevel($this->user)[0]->level;
        $this->time = 12;
    }

    public function filter ($time) {
        $this->time = $time;
        $this->mount($this->time);
    }

    public function mount () {
        $this->sales = $this->salesService->listMySalesByTime ($this->time);
        foreach ($this->sales as $sale) {
            $this->collaboratorsAmount = 0;
            $this->details[$sale->id] = $this->detailService->getSaleDetail($sale);
            $this->sellers[$sale->id] = $this->sellerService->getSeller($sale);
            $this->listers[$sale->id] = $this->listerService->getLister($sale);
            $this->collaborators[$sale->id] = $this->salesService->getCollaborators($sale);
        
            if (count($this->collaborators[$sale->id]) > 0) {
                foreach ($this->collaborators[$sale->id] as $collaborator) {
                    $this->collaboratorsAmount += $collaborator->commission;
                }   
            }

            //dd(200000 * (0.05 - 0) * 0.25);
            if ($this->listers[$sale->id] == $this->sellers[$sale->id]) {
                $this->income[$sale->id] = ($this->salesService->getAmount($sale) / 100) * (($sale->commission / 10000) - ($this->collaboratorsAmount / 10000)) * ($this->level / 100);
            } else {
                $this->income[$sale->id] = ($this->salesService->getAmount($sale) / 100) * (($sale->commission / 10000) - ($this->collaboratorsAmount / 10000)) * (($this->level / 2) / 100);
            }
        }
    }   

    public function render ()
    {  
        return view('livewire.filter-operations', [
            'sales' => $this->sales,
            'details' => $this->details,
            'sellers' => $this->sellers,
            'listers' => $this->listers,
            'income' => $this->income,
            'time' => $this->time
        ]);
    }
}
