<?php

namespace App\Repositories\Team;

use App\Models\TeamType;

class TeamTypeRepository {
  public function getTypes () {
    return TeamType::all();
  }

  public function userCanDelete ($userId, $typeId) {
    
    if (TeamType::find($typeId)->user_id == $userId) {
      return true;
    }

    return false;
  }

  public function listVinculatedTeams ($typeId) {
    return TeamType::find($typeId)->historics;
  }

  public function destroyType($id) {
    return TeamType::find($id)->delete();
  }

  public function updateType ($id, array $data) {
    $type = TeamType::find($id);

    if ($type != null) {
      $type->name = $data['name'];
      $type->central = $data['central'];
      $type->sip = $data['sip'];
      $type->marketing = $data['marketing'];
      $type->support = $data['support'];
      $type->save();
      
      return true;
    }

    return false;
  }

  public function setType ($data) {
    return TeamType::create($data);
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