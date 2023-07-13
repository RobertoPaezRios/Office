<?php

namespace App\Repositories\Mails;

use App\Models\GroupInvitation;

class GroupInvitationRepository {
  public function createInvitation (array $data) {
    return GroupInvitation::create($data);
  }

  public function getInvitation($token){
    return GroupInvitation::where('token', $token)->first();
  }

  public function deleteInvitation ($token) {
    $invitation = GroupInvitation::where('token', $token)->first();

    if (!is_null($invitation)) {
      return $invitation->delete();
    }

    return false;
  }

  public function listInvitationsByGroupId($groupId) {
    return GroupInvitation::where('group_id', $groupId)->get();
  }
}