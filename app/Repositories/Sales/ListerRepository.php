<?php

namespace App\Repositories\Sales;

use App\Models\Sale;

class ListerRepository {
  public function getLister (Sale $sale) {
    return $sale->lister;
  }
}