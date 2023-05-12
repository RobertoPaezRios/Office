<?php

namespace App\Repositories;

use App\Models\TeamType;

class TeamTypeRepository {
  public function getTypes () {
    return TeamType::all();
  }
}