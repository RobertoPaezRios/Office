<?php

namespace App\Repositories\Owners;

use App\Models\OwnerGroup;

class OwnerGroupRepository {
  public function getOwner ($userId) {
    return OwnerGroup::where('user_id', $userId)->get()[0]->owner; 
  }

  public function getOwnerGroupByUserId ($userId) {
    return OwnerGroup::where('user_id', $userId)->get();
  }

  public function createGroup ($userId, $name) {
    return OwnerGroup::create ([
      'user_id' => $userId, 
      'name' => $name
    ]);
  }
}