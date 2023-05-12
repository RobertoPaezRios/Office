<?php

namespace App\Services\Sales;

use App\Models\Sale;

use App\Repositories\Sales\DetailRepository;

class DetailService {
  private $detailRepository;

  public function __construct (DetailRepository $detailRepository) {
    $this->detailRepository = $detailRepository;
  }

  public function getDetail ($id) {
    return $this->detailRepository->getDetail($id);
  }

  public function getSaleDetail (Sale $sale) {
    return $this->detailRepository->getSaleDetail($sale);
  }
}