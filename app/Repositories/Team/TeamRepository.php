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

  public function listMembersByTeamId ($teamId) {
    $team = Team::find($teamId);
    return $team->users;
  }

  public function listTeamsByGroupId($groupId) {
    return Team::where('group_id', $groupId)->get();
  }

  public function getPersonalTeam ($userId) {
    return Team::where('user_id', $userId)->where('personal_team', 1)->first();
  }
}