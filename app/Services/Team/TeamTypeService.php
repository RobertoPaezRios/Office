<?php

namespace App\Services\Team;

use App\Repositories\Team\TeamTypeRepository;

use App\Models\TeamType;

class TeamTypeService {
  private $teamTypeRepository;

  public function __construct (TeamTypeRepository $teamTypeRepository) {
    $this->teamTypeRepository = $teamTypeRepository;
  }

  public function getType ($id) {
    return $this->teamTypeRepository->getType($id);
  }

  public function getTypes () {
    return $this->teamTypeRepository->getTypes();
  }

  public function getOwner ($typeId) {
    return $this->teamTypeRepository->getOwner($typeId);
  }
}