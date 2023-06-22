<?php

namespace App\Services\Owners;

use App\Repositories\Owners\OwnerRepository;

class OwnerService {
  private $ownerRepository;
  
  public function __construct (OwnerRepository $ownerRepository) {
    $this->ownerRepository = $ownerRepository;
  }

  public function getMyGroup ($userId) {
    return $this->ownerRepository->getMyGroup ($userId);
  }

  public function listMembersByGroupId ($groupId) {
    return $this->ownerRepository->listMembersByGroupId($groupId);
  }
}