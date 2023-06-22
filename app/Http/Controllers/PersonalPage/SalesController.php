<?php

namespace App\Http\Controllers\PersonalPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\Team\TeamService;
use App\Services\Sales\SalesService;
use App\Services\Sales\DetailService;
use App\Services\Sales\ListerService;
use App\Services\Sales\SellerService;
use App\Services\Levels\LevelService;

class SalesController extends Controller
{
    private $teamService;
    private $salesService;
    private $detailService;
    private $listerService;
    private $sellerService;
    private $levelService;

    public function __construct (
        TeamService $teamService,
        SalesService $salesService,
        DetailService $detailService,
        ListerService $listerService,
        SellerService $sellerService,
        LevelService $levelService
    ) {
        $this->teamService = $teamService;
        $this->salesService = $salesService;
        $this->detailService = $detailService;
        $this->listerService = $listerService;
        $this->sellerService = $sellerService;
        $this->levelService = $levelService;
    }

    public function index () {
        if (!$this->teamService->getTeam(Auth::user()->current_team_id)->personal_team) {
            return redirect()->route('dashboard');
        }
        
        $user = Auth::user();
        $sales = $this->salesService->listMySales($user);
        $details = [];
        $income = [];
        $listers = [];
        $sellers = [];
        $collaborators = [];
        $level = $this->levelService->getLevel($user)[0]->level;
        $total = 0;

        foreach ($sales as $sale) {
            $collaboratorsAmount = 0;
            $details [$sale->id] = $this->detailService->getSaleDetail($sale);
            $listers [$sale->id] = $this->listerService->getLister($sale);
            $sellers [$sale->id] = $this->sellerService->getSeller($sale);
            $collaborators [$sale->id] = $this->salesService->getCollaborators($sale);

            if (count($collaborators [$sale->id]) > 0) {
                foreach ($collaborators[$sale->id] as $collaborator) {
                    $collaboratorsAmount += $collaborator->commission ;
                }
            }

            //IF THE SELLER AND THE LISTER ARE THE SAME 
            if ($listers[$sale->id] == $sellers[$sale->id]) {
                $income [$sale->id] = ($this->salesService->getAmount($sale) / 100) * (($sale->commission - $collaboratorsAmount) / 10000) * ($level / 100);
            } else {
                $income [$sale->id] = ($this->salesService->getAmount($sale) / 100) * (($sale->commission - $collaboratorsAmount) / 10000) * ($level / 100) / 2;
            }
            $total += $income [$sale->id];
        }

        return view('personal-page.operations', [
            'total' => $total,
            'nSales' => count($sales),
            'sales' => $sales,
            'details' => $details,
            'income' => $income,
            'sellers' => $sellers,
            'listers' => $listers
        ]);
    }
}
