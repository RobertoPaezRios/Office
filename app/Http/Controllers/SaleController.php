<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Services\Sales\SalesService;
use App\Services\Sales\ListerService;
use App\Services\Sales\SellerService;
use App\Services\Sales\BuyersService;
use App\Services\Sales\SellersService;
use App\Services\Sales\DetailService;

use App\Services\Team\TeamService;

class SaleController extends Controller
{
    private $salesService;
    private $listerService;
    private $sellerService;
    private $buyersService;
    private $sellersService;
    private $detailService;
    
    private $teamService;

    public function __construct (
        SalesService $salesService, 
        ListerService $listerService, 
        SellerService $sellerService,
        BuyersService $buyersService,
        SellersService $sellersService,
        DetailService $detailService,
        TeamService $teamService
        ) {
        $this->salesService = $salesService;
        $this->listerService = $listerService;
        $this->sellerService = $sellerService;
        $this->buyersService = $buyersService;
        $this->sellersService = $sellersService;
        $this->detailService = $detailService;
        $this->teamService = $teamService;
    }

    public function display ($id) {
        $sale = $this->salesService->getSale($id); 
        $user = Auth::user();   
        $team = $this->teamService->getTeam($user->current_team_id);

        if (!empty($sale)) {
            
            if ($this->salesService->checkTeam($sale, $team) || $this->salesService->iParticipate($sale, $user)) {
                $detail   = $this->detailService->getSaleDetail($sale); 
                $lister   = $this->listerService->getLister($sale);
                $seller   = $this->sellerService->getSeller($sale);
                $buyers   = $this->buyersService->getBuyers($sale);
                $sellers  = $this->sellersService->getSellers($sale);
                $commType = $this->salesService->getCommission($sale);
                $levels[] = $this->listerService->getLister($sale)->level;
                $levels[] = $this->sellerService->getSeller($sale)->level;
                $collaborators = '';

                //IF THERE WERE ANY COLLABORATOR THE COMMISION IS DISTRIBUTED
                if (!empty($this->salesService->getCollaborators($sale))) {
                    $collaborators = $this->salesService->getCollaborators($sale);
                    $commType = $this->salesService->getCommission($sale);
                    $commType -= $this->salesService->collaboratorsAmount($collaborators);
                }

                $netCommission = ($this->salesService->getAmount($sale) / 100) * ($commType / 10000); 

                return view('operations.operation', [
                    'sale' => $sale,
                    'detail' => $detail,
                    'lister' => $lister,
                    'seller' => $seller,
                    'buyers' => $buyers,
                    'sellers' => $sellers,
                    'collaborators' => $collaborators,
                    'netCommission' => $netCommission,
                    'levels' => $levels,
                    'commType' => $commType
                 ]);
            } 
        }
    
        return redirect()->route('operations');
    }

    public function store () {

    }

    public function update () {

    }

    public function destroy () {

    }
}
