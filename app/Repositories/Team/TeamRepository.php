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

  public function getPersonalTeam ($userId) {
    return Team::where('user_id', $userId)->where('personal_team', 1)->first();
  }
}