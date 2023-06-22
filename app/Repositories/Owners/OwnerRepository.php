<?php

namespace App\Repositories\Owners;

use App\Models\Owner;

class OwnerRepository {
  public function getMyGroup ($userId) {
    return Owner::where('user_id', $userId)->get()->owner_group;
  }

  public function listMembersByGroupId($groupId) {
    return Owner::where('group_id', $groupId)->get();
  }
}