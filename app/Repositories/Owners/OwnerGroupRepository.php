<?php

namespace App\Repositories\Owners;

use App\Models\OwnerGroup;

class OwnerGroupRepository {
  public function getOwner ($userId) {
    return OwnerGroup::where('user_id', $userId)->get()[0]->owner; 
  }

  public function getGroup ($id) {
    return OwnerGroup::find($id);
  }
  
  public function getColorByGroupId ($groupId) {
    return OwnerGroup::find($groupId)->color;
  }

  public function setColor ($color, $groupId) {
    $group = OwnerGroup::find($groupId);

    if ($group) {
      $group->color = $color;
      $group->save();
      return true;
    } 
    
    return false;
  }

  public function getOwnerByGroupId ($groupId) {
    return OwnerGroup::find($groupId)->owner;
  }

  public function listOwnerGroupByUserId ($userId) {
    return OwnerGroup::where('user_id', $userId)->get();
  }

  public function createGroup ($userId, $name) {
    return OwnerGroup::create ([
      'user_id' => $userId, 
      'name' => $name
    ]);
  }
}