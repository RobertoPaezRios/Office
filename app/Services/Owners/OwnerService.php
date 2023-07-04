<?php

namespace App\Services\Owners;

use App\Repositories\Owners\OwnerRepository;

class OwnerService {
  private $ownerRepository;
  
  public function __construct (OwnerRepository $ownerRepository) {
    $this->ownerRepository = $ownerRepository;
  }

  public function listGroupsByMemberId ($memberId) {
    return $this->ownerRepository->listGroupsByMemberId ($memberId);
  }

  public function belongsTo ($userId, $groupId) {
    return $this->ownerRepository->belongsTo($userId, $groupId);
  }

  public function getMyGroup ($userId) {
    return $this->ownerRepository->getMyGroup ($userId);
  }

  public function listMembersByGroupId ($groupId) {
    return $this->ownerRepository->listMembersByGroupId($groupId);
  }
}