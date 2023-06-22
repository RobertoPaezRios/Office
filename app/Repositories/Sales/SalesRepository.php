<?php

namespace App\Repositories\Sales;

use App\Models\Sale;
use Illuminate\Support\Carbon;

class SalesRepository {
  public function getMySalesWithPaginate ($idUser, $itemsPerPage) {
    return Sale::where('lister_id', $idUser)->orwhere('seller_id', $idUser)->paginate($itemsPerPage);
  }

  public function listSalesByTypeId ($id) {
    return Sale::where('type_id', $id)->get();
  }
  
  public function listMySalesByTime ($time) {
    return Sale::whereBetween('created_at', [
      Carbon::now()->subMonths($time)->format('Y-m-d'),
      Carbon::now()->format('Y-m-d')
    ])->get();
  }

  public function listMySales ($user) {
    return Sale::where('lister_id', $user->id)->orwhere('seller_id', $user->id)->get();
  }

  public function listMySalesWithPaginate ($userId, $itemsPerPage) {
    return Sale::where('lister_id', $userId)->orwhere('seller_id', $userId)->paginate($itemsPerPage);
  }

  public function countSalesByHistoricsIds (array $ids) {
    return count(Sale::whereIn('team_type_history_id', $ids)->get()->toArray());
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