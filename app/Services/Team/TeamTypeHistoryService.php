<?php
namespace App\Services\Team;

use App\Repositories\Team\TeamTypeHistoryRepository;
use App\Models\Team;

class TeamTypeHistoryService {
  private $teamTypeHistoryRepository;

  public function __construct (TeamTypeHistoryRepository $teamTypeHistoryRepository) {
    $this->teamTypeHistoryRepository = $teamTypeHistoryRepository;
  }

  public function getTeamTypeHistory (Team $team) {
    return $this->teamTypeHistoryRepository->getTeamTypeHistory($team);
  }

  public function setTeamTypeHistory ($teamId, $typeId) {
    return $this->teamTypeHistoryRepository->setTeamTypeHistory([
      'team_id' => $teamId,
      'type_id' => $typeId,
    ]);
  }
}