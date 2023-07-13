<?php

namespace App\Services\Mails;

use App\Repositories\Mails\GroupInvitationRepository;

class GroupInvitationService {
  private $groupInvitationRepository;

  public function __construct (
    GroupInvitationRepository $groupInvitationRepository
  ) {
    $this->groupInvitationRepository = $groupInvitationRepository;
  }

  public function getInvitation($token) {
    return $this->groupInvitationRepository->getInvitation($token);
  }

  public function deleteInvitation($token) {
    return $this->groupInvitationRepository->deleteInvitation($token);
  }

  public function createInvitation (array $data) {
    return $this->groupInvitationRepository->createInvitation($data);
  }

  public function listInvitationsByGroupId($groupId) {
    return $this->groupInvitationRepository->listInvitationsByGroupId($groupId);
  }
}