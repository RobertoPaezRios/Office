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

  public function getPersonalTeam ($userId) {
    return $this->teamRepository->getPersonalTeam($userId);
  }

  public function listMembersByTeamId ($teamId) {
    return $this->teamRepository->listMembersByTeamId($teamId);
  }

  public function listTeamsByGroupId($groupId) {
    return $this->teamRepository->listTeamsByGroupId($groupId);
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
    if ($team) {
      if ($team->personal_team == 1) return true;
      
      return false;
    }

    return abort(419);
  }
}