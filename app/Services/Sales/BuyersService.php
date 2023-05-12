<?php

namespace App\Services\Sales;

use App\Repositories\Sales\BuyersRepository;
use App\Models\Sale;

class BuyersService {
  private $buyersRepository;

  public function __construct (BuyersRepository $buyersRepository) {
    $this->buyersRepository = $buyersRepository;
  }

  public function getBuyers (Sale $sale) {
    return $this->buyersRepository->getBuyers($sale);
  }
}