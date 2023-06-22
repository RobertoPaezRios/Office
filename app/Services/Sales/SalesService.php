<?php

namespace App\Services\Sales;

use App\Models\Sale;
use App\Models\User;
use App\Models\Team;

use App\Repositories\Sales\SalesRepository;
use App\Services\Sales\ListerService;
use App\Services\Sales\SellerService;
use App\Services\Sales\DetailService;

class SalesService {
  private $saleRepository;
  private $listerService;
  private $sellerService;
  private $detailService;

  public function __construct (
    SalesRepository $saleRepository, 
    ListerService $listerService,
    SellerService $sellerService,
    DetailService $detailService
    ) {
    $this->saleRepository = $saleRepository;
    $this->listerService = $listerService;
    $this->sellerService = $sellerService;
    $this->detailService = $detailService;
  }

  public function getMySales(User $user) {
    return $this->saleRepository->getMySales($user);
  }

  public function listMySales(User $user) {
    return $this->saleRepository->listMySales($user);
  }

  public function listMySalesByTime ($time) {
    return $this->saleRepository->listMySalesByTime($time);
  }

  public function getMySalesWithPaginate ($idUser, $itemsPerPage) {
    return $this->saleRepository->getMySalesWithPaginate($idUser, $itemsPerPage);
  }

  public function listMySalesWithPaginate ($userId, $itemsPerPage) {
    return $this->saleRepository->listMySalesWithPaginate ($userId, $itemsPerPage);
  }

  public function listSalesByTypeId ($id) {
    return $this->saleRepository->listSalesByTypeId($id);
  }

  public function countSalesByHistoricsIds (array $ids) {
    return $this->saleRepository->countSalesByHistoricsIds($ids);
  }

  public function getSale($id) {
    return $this->saleRepository->getSale($id);
  }

  public function getCollaborators (Sale $sale) {
    return $this->saleRepository->getCollaborators($sale);
  }

  public function getCommission (Sale $sale) {
    return $this->saleRepository->getCommission($sale);
  }

  public function getAmount (Sale $sale) {
    return $this->saleRepository->getAmount($sale);
  }

  public function checkTeam (Sale $sale, Team $team) {
    if ($this->saleRepository->getTeam($sale) == $team) return true;
    
    return false;
  }

  public function iParticipate (Sale $sale, User $user) {
    if ($this->listerService->getLister($sale)->id == $user->id 
    || $this->sellerService->getSeller($sale)->id == $user->id) return true;

    return false;
  }

  public function collaboratorsAmount ($collaborators) {
    $amount = 0;
    
    foreach ($collaborators as $collaborator) {
      $amount += $collaborator->commission;
    }

    return $amount;
  }
}