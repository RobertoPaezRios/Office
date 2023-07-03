<?php

namespace App\Services\Owners;

use App\Repositories\Owners\OwnerGroupRepository;
use App\Services\Owners\OwnerService;
use App\Services\User\UserService;
use App\Services\Team\TeamService;

class OwnerGroupService {
  private $ownerGroupRepository;
  private $ownerService;
  private $userService;
  private $teamService;

  public function __construct (
    OwnerGroupRepository $ownerGroupRepository,
    OwnerService $ownerService,
    UserService $userService,
    TeamService $teamService
  ) {
    $this->ownerGroupRepository = $ownerGroupRepository;
    $this->ownerService = $ownerService;
    $this->userService = $userService;
    $this->teamService = $teamService;
  }
  
  public function setColor ($color, $groupId) {
    return $this->ownerGroupRepository->setColor($color, $groupId);
  }

  public function getColorByGroupId ($groupId) {
    return $this->ownerGroupRepository->getColorByGroupId($groupId);
  }

  public function listOwnerGroupByUserId ($userId) {
    return $this->ownerGroupRepository->listOwnerGroupByUserId($userId);
  }

  public function listTeamsByGroupId ($groupId) {
    return $this->teamService->listTeamsByGroupId($groupId);
  }

  public function checkIfNameIsAvailable ($name, $userId) {
    $groups = $this->ownerGroupRepository->listOwnerGroupByUserId($userId);

    foreach ($groups as $group) {
      if ($group->name == $name) return false; 
    }

    return true;
  }

  public function getGroup ($id) {
    return $this->ownerGroupRepository->getGroup($id);
  }

  public function getOwnerByGroupId ($groupId) {
    return $this->ownerGroupRepository->getOwnerByGroupId($groupId);
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