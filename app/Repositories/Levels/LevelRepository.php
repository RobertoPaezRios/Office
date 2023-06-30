<?php

namespace App\Repositories\Levels;

use App\Models\Level;
use App\Models\User;
use App\Models\Team;

class LevelRepository {
  public function getLevel (User $user) {
    return Level::where('user_id', $user->id)->get();
  }

  public function createLevel (User $user, int $level, Team $team) {
    return Level::create ([
      'user_id' => $user->id,
      'team_id' => $team->id,
      'level' => $level
    ]);
  }
}