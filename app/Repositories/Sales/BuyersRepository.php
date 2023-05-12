<?php

namespace App\Repositories\Sales;

use App\Models\Sale;

class BuyersRepository {
  public function getBuyers (Sale $sale) {
    return $sale->buyers;
  }
}