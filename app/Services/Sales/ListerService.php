<?php

namespace App\Services\Sales;

use App\Repositories\Sales\ListerRepository;
use App\Models\Sale;

class ListerService {
  private $listerRepository;
  
  public function __construct (ListerRepository $listerRepository) {
    $this->listerRepository = $listerRepository;
  }

  public function getLister (Sale $sale) {
    return $this->listerRepository->getLister($sale);
  }
}