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

  public function destroyTeamTypeHistory ($id) {
    return TeamTypeHistory::find($id)->delete();
  }

  public function getTeamActualType (Team $team) {
    return TeamTypeHistory::where('team_id', $team->id)->orderBy('created_at', 'desc')->get();
  }
}