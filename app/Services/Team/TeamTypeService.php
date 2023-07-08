<?php

namespace App\Services\Team;

use App\Repositories\Team\TeamTypeRepository;
use App\Repositories\Team\TeamTypeHistoryRepository;

use App\Models\TeamType;

class TeamTypeService {
  private $teamTypeRepository;

  public function __construct (TeamTypeRepository $teamTypeRepository) {
    $this->teamTypeRepository = $teamTypeRepository;
  }

  public function getOwnerByUuid($uuid) {
    return $this->teamTypeRepository->getOwnerByUuid($uuid);
  }

  public function userCanDelete ($userId, $typeId) {
    return $this->teamTypeRepository->userCanDelete($userId, $typeId);
  }

  public function listVinculatedTeams ($typeId) {
    return $this->teamTypeRepository->listVinculatedTeams ($typeId);
  }

  public function updateType ($id, array $data) {
    return $this->teamTypeRepository->updateType($id, $data);
  }

  public function listTypesByGroupId($groupId) {
    return $this->teamTypeRepository->listTypesByGroupId($groupId);
  }

  public function destroyType ($id) {
    return $this->teamTypeRepository->destroyType($id);
  }

  public function getType ($id) {
    return $this->teamTypeRepository->getType($id);
  }

  public function getTypeByUuid($uuid) {
    return $this->teamTypeRepository->getTypeByUuid($uuid);
  }

  public function setType ($data) {
    return $this->teamTypeRepository->setType($data);
  }

  public function getUserTypes ($userId) {
    return $this->teamTypeRepository->getUserTypes($userId);
  }

  public function getUserTypesWithPaginate($userId, $itemsPerPage) {
    return $this->teamTypeRepository->getUserTypesWithPaginate($userId, $itemsPerPage);
  }

  public function getTypes () {
    return $this->teamTypeRepository->getTypes();
  }

  public function getOwner ($typeId) {
    return $this->teamTypeRepository->getOwner($typeId);
  }
}