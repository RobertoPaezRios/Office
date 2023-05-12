<?php

namespace App\Repositories\Sales;

use App\Models\Collaborator;

class CollaboratorRepository {
  public function collaboratorCommission (Collaborator $collaborator) {
    return $collaborator->commission;
  }
}