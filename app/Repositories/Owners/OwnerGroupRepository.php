<?php

namespace App\Repositories\Owners;

use App\Models\OwnerGroup;

class OwnerGroupRepository {
  public function getOwner ($groupId) {
    return OwnerGroup::find($groupId)->owner;
  }
}