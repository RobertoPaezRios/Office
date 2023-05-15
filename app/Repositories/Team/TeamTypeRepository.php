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

  public function getOwner ($typeId) {
    return TeamType::find($typeId)->user_id;
  }
}