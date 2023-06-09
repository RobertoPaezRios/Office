<?php

namespace App\Repositories\Owners;

use App\Models\Owner;

class OwnerRepository {
  public function getMyGroup ($userId) {
    return Owner::where('user_id', $userId)->get()->owner_group;
  }

  public function getOwner ($id) {
    return Owner::find($id);
  }

  public function listGroupsByMemberId ($memberId) {
    return Owner::where('user_id', $memberId)->get();
  }

  public function destroy ($id) {
    return Owner::find($id)->delete();
  }

  public function belongsTo ($userId, $groupId) {
    return Owner::where('user_id', $userId)->where('group_id', $groupId)->get();
  }

  public function listMembersByGroupId($groupId) {
    return Owner::where('group_id', $groupId)->get();
  }
}