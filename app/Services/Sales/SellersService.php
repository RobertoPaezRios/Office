<?php

namespace App\Services\Sales;

use App\Repositories\Sales\SellersRepository;
use App\Models\Sale;

class SellersService {
  private $sellersRepository;

  public function __construct (SellersRepository $sellersRepository) {
    $this->sellersRepository = $sellersRepository;
  }

  public function getSellers (Sale $sale) {
    return $this->sellersRepository->getSellers($sale);
  }
}