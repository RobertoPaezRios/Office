<?php

namespace App\Services\Team;

use App\Models\User;

use App\Services\Sales\SalesService;
use App\Services\Team\TeamService;
use App\Services\Sales\ListerService;
use App\Services\Sales\SellerService;
use App\Services\Levels\LevelService;
use App\Services\Sales\DetailService;

class PersonalTeamService {
  private $salesService;
  private $teamService;
  private $listerService;
  private $sellerService;
  private $levelService;
  private $detailService;

  public function __construct (
    SalesService $salesService,
    TeamService $teamService, 
    ListerService $listerService, 
    SellerService $sellerService, 
    LevelService $levelService, 
    DetailService $detailService
  ) {
    $this->salesService = $salesService;
    $this->teamService = $teamService;
    $this->listerService = $listerService;
    $this->sellerService = $sellerService;
    $this->levelService = $levelService;
    $this->detailService = $detailService;
  }

  public function display (User $user) {  
    $sales = $this->salesService->getMySalesWithPaginate($user->id, 4);

    if (!empty($sales)) {
      $listers = [];
      $sellers = [];
      $details = [];
      $nSales = 0;
      $income = [];
      $level = $this->levelService->getLevel($user);
      $total = 0;

      foreach ($sales as $key => $sale) {
        $listers[] = $this->listerService->getLister($sale);
        $sellers[] = $this->sellerService->getSeller($sale);
        $details[] = $this->detailService->getSaleDetail($sale);
        $auxComm[] = $this->salesService->getCommission($sale);

        $this->salesService->iParticipate($sale, $user) ? $nSales++ : 0;

        //IF THERE WERE ANY COLLABORATOR THE COMMISION IS DISTRIBUTED
        if (!empty($this->salesService->getCollaborators($sale))) {
            $collaborators = $this->salesService->getCollaborators($sale);
            $auxComm[$key] -= $this->salesService->collaboratorsAmount($collaborators);
        }
        
        $income[] = ($this->salesService->getAmount($sale) / 100) * (($auxComm[$key] / 10000) * (($level[0]->level / 100) / 2));
        
        if ($this->sellerService->getSeller($sale)->id == $user->id && $this->listerService->getLister($sale)->id == $user->id) {
            $income[$key] *= 2;
        }

        $total += $income[$key];
      } 

      return [
        'sales' => $sales, 
        'listers' => $listers, 
        'sellers' => $sellers, 
        'details' => $details,
        'income' => $income,
        'total' => $total,
        'nSales' => $nSales,
        'role' => 'Personal Page',
        'status' => 'ok'
      ];
    }
    return [
      'role' => 'Personal Page',
      'status' => 'error'
    ];
  }
}