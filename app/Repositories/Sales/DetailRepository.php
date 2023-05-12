<?php

namespace App\Repositories\Sales;

use App\Models\Detail;
use App\Models\Sale;

class DetailRepository {
  public function getDetail ($id) {
    return Detail::find($id);
  }

  public function getSaleDetail (Sale $sale) {
    return $sale->detail;
  }
}