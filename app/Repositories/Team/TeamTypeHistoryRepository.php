<?php
namespace App\Repositories\Team;

use App\Models\TeamTypeHistory;
use App\Models\Team;

class TeamTypeHistoryRepository {
  public function getTeamTypeHistory (Team $team) {
    return TeamTypeHistory::team();
  }

  public function setTeamTypeHistory (Array $data) {
    return TeamTypeHistory::create($data);
  }
}