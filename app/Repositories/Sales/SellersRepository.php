<?php

namespace App\Repositories\Sales;

use App\Models\Sale;

class SellersRepository {
  public function getSellers (Sale $sale) {
    return $sale->sellers;
  }
}