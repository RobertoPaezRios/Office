<?php

namespace App\Repositories\Team;

use App\Models\Team;

class TeamRepository {
  public function getTeam($id) {
    return Team::find($id);
  }

  public function isPersonal (Team $team) {
    return $team->personal_team;
  }
}