<?php

namespace App\Services\Team;

use App\Repositories\Team\TeamRepository;
use App\Repositories\Team\TeamTypeHistoryRepository;

use App\Models\Team;

class TeamService {
  private $teamRepository;
  private $teamTypeHistoryRepository;

  public function __construct (
    TeamRepository $teamRepository,
    TeamTypeHistoryRepository $teamTypeHistoryRepository
  ) {
    $this->teamRepository = $teamRepository;
    $this->teamTypeHistoryRepository = $teamTypeHistoryRepository;
  }

  public function getTeamActualType (Team $team) {
    return $this->teamTypeHistoryRepository->getTeamActualType($team);
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