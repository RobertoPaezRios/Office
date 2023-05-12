<?php

namespace App\Services\Team;

use App\Repositories\Team\TeamTypeRepository;

class TeamTypeService {
  private $teamTypeRepository;

  public function __construct (TeamTypeRepository $teamTypeRepository) {
    $this->teamTypeRepository = $teamTypeRepository;
  }

  public function getTypes () {
    return $this->teamTypeRepository->getTypes();
  }
}