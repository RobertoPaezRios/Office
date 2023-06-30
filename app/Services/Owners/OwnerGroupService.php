<?php

namespace App\Services\Owners;

use App\Repositories\Owners\OwnerGroupRepository;
use App\Services\Owners\OwnerService;
use App\Services\User\UserService;

class OwnerGroupService {
  private $ownerGroupRepository;
  private $ownerService;
  private $userService;

  public function __construct (
    OwnerGroupRepository $ownerGroupRepository,
    OwnerService $ownerService,
    UserService $userService
  ) {
    $this->ownerGroupRepository = $ownerGroupRepository;
    $this->ownerService = $ownerService;
    $this->userService = $userService;
  }
  
  public function listOwnerGroupByUserId ($userId) {
    return $this->ownerGroupRepository->listOwnerGroupByUserId($userId);
  }

  public function checkIfNameIsAvailable ($name, $userId) {
    $groups = $this->ownerGroupRepository->listOwnerGroupByUserId($userId);

    foreach ($groups as $group) {
      if ($group->name == $name) return false; 
    }

    return true;
  }

  public function getGroupOwner ($groupId) {
    $id = $this->ownerGroupRepository->getGroup($groupId)->user_id;
    return $this->userService->getUserById($id);
  }

  public function listMyMembers ($groupId) {
    return $this->ownerService->listMembersByGroupId ($groupId);
  }

  public function getOwner ($userId) {
    return $this->ownerGroupRepository->getOwner($userId);
  }

  public function createGroup ($userId, $name) {
    return $this->ownerGroupRepository->createGroup($userId, $name);
  }
}