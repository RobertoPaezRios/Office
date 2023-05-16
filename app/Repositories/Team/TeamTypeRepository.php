<?php

namespace App\Repositories\Team;

use App\Models\TeamType;

class TeamTypeRepository {
  public function getTypes () {
    return TeamType::all();
  }

  public function getType ($id) {
    return TeamType::find($id);
  }

  public function getUserTypes ($userId) {
    return TeamType::where('user_id', $userId)->get();
  }

  public function getUserTypesWithPaginate($userId, $itemsPerPage) {
    return TeamType::where('user_id', $userId)->paginate($itemsPerPage);
  }

  public function getOwner ($typeId) {
    return TeamType::find($typeId)->user_id;
  }
}