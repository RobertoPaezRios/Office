<?php

namespace App\Services\Owners;

use App\Repositories\Owners\OwnerGroupRepository;
use App\Services\Owners\OwnerService;

class OwnerGroupService {
  private $ownerGroupRepository;
  private $ownerService;

  public function __construct (
    OwnerGroupRepository $ownerGroupRepository,
    OwnerService $ownerService
  ) {
    $this->ownerGroupRepository = $ownerGroupRepository;
    $this->ownerService = $ownerService;
  }
  
  public function listMyMembers ($groupId) {
    return $this->ownerService->listMembersByGroupId ($groupId);
  }

  public function getOwner ($groupId) {
    return $this->ownerGroupRepository->getOwner($groupId);
  }
}