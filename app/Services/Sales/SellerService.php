<?php

namespace App\Services\Sales;

use App\Repositories\Sales\SellerRepository;
use App\Models\Sale;

class SellerService {
  private $sellerRepository;

  public function __construct (SellerRepository $sellerRepository) {
    $this->sellerRepository = $sellerRepository;
  }

  public function getSeller (Sale $sale) {
    return $this->sellerRepository->getSeller($sale);
  }
}
