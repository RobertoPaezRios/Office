<?php

namespace App\Repositories\Sales;

use App\Models\Sale;

class SellerRepository {
  public function getSeller (Sale $sale) {
    return $sale->seller;
  }
}