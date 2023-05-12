<?php

namespace App\Services\Team;

use App\Repositories\Team\TeamRepository;

use App\Models\Team;

class TeamService {
  private $teamRepository;

  public function __construct (TeamRepository $teamRepository) {
    $this->teamRepository = $teamRepository;
  }

  public function getTeam ($id) {
    return $this->teamRepository->getTeam($id);
  }

  public function getType (Team $team) {
    return $this->teamRepository->getType($team);
  }

  public function isPersonal (Team $team) {
    return $this->teamRepository->isPersonal($team);
  }
}