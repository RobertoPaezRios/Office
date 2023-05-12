<?php

namespace App\Repositories\Sales;

use App\Models\Sale;

class SalesRepository {
  public function getMySalesWithPaginate ($idUser, $itemsPerPage) {
    return Sale::where('lister_id', $idUser)->orwhere('seller_id', $idUser)->paginate($itemsPerPage);
  }

  public function getMySales($idUser) {
    return Sale::where('lister_id', $idUser)->orwhere('seller_id', $idUser)->get();
  }

  public function getSale ($id) {
    return Sale::find($id);
  }

  public function getAmount (Sale $sale) {
    return $sale->amount;
  }

  public function getCollaborators (Sale $sale) {
    return $sale->collaborators;
  }

  public function getTeam (Sale $sale) {
    return $sale->team;
  }

  public function getCommission (Sale $sale) {
    return $sale->commission;
  }
}