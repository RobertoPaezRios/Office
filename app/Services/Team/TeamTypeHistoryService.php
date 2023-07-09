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

  public function listSalesByHistoric ($historicId) {
    return $this->teamTypeHistoryRepository->listSalesByHistoric($historicId);
  }

  public function listTeamTypeHistoricsByTypeId ($typeId) {
    return $this->teamTypeHistoryRepository->listTeamTypeHistoricsByTypeId($typeId);
  }

  public function listTeamTypeHistoricsIds ($historicId) {
    return $this->teamTypeHistoryRepository->listTeamTypeHistoricsIds($historicId);
  }

  public function getTeamActualType ($teamId) {
    return $this->teamTypeHistoryRepository->getTeamActualType($teamId);
  }

  public function getTeamTypeHistoryById ($id) {
    return $this->teamTypeHistoryRepository->getTeamTypeHistoryById($id);
  }

  public function listTeamTypeHistorics ($typeId) {
    return $this->teamTypeHistoryRepository->listTeamTypeHistorics ($typeId);
  }

  public function updateTeamTypeHistory ($id, $typeId) {
    $this->teamTypeHistoryRepository->updateTeamTypeHistory($id, $typeId);
  }

  public function destroyTeamTypeHistory ($id) {
    return $this->teamTypeHistoryRepository->destroyTeamTypeHistory($id);
  }

  public function setTeamTypeHistory ($teamId, $typeId) {
    return $this->teamTypeHistoryRepository->setTeamTypeHistory([
      'team_id' => $teamId,
      'type_id' => $typeId,
    ]);
  }

  public function userCanDelete ($userId, $typeId) {
    if ($this->teamTypeHistoryRepository->getTeamTypeHistoryById($typeId)) { 
      return $this->teamTypeHistoryRepository->getTeamTypeHistoryUserOwner($typeId) == $userId;
    }
    
    return false;
  }
}