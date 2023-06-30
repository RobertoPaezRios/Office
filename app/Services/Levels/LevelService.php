<?php

namespace App\Services\Levels;

use App\Repositories\Levels\LevelRepository;

use App\Models\User;
use App\Models\Team;

class LevelService {
  private $levelRepository;

  public function __construct (LevelRepository $levelRepository) {
    $this->levelRepository = $levelRepository;
  }

  public function getLevel (User $user) {
    return $this->levelRepository->getLevel($user);
  }

  public function createLevel (User $user, int $level, Team $team) {
    return $this->levelRepository->createLevel($user, $level, $team);
  }
}