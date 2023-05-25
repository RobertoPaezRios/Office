<?php
namespace App\Repositories\Team;

use App\Models\TeamTypeHistory;
use App\Models\Team;

class TeamTypeHistoryRepository {
  public function getTeamTypeHistory (Team $team) {
    return TeamTypeHistory::where('team_id', $team->id)->get();
  }

  public function setTeamTypeHistory (Array $data) {
    return TeamTypeHistory::create($data);
  }

  public function updateTeamTypeHistory ($id, $typeId) {
    if (TeamTypeHistory::find($id)) {
      $type = TeamTypeHistory::find($id);
      $type->type_id = $typeId;
      return $type->save();
    }

    return false;
  }

  public function destroyTeamTypeHistory ($id) {
    return TeamTypeHistory::find($id)->delete();
  }

  public function getTeamActualType (Team $team) {
    return TeamTypeHistory::where('team_id', $team->id)->orderBy('created_at', 'desc')->get();
  }

  public function getTeamTypeHistoryByTeamId ($teamId) {
    return TeamTypeHistory::where('team_id', $teamId)->get();
  }

  public function getTeamTypeHistoryById ($id) {
    return TeamTypeHistory::find($id);
  }

  public function getTeamTypeHistoryUserOwner ($typeId) {
    return TeamTypeHistory::find($typeId)->type->user_id;
  }
}