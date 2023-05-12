<?php

namespace App\Repositories\Levels;

use App\Models\Level;
use App\Models\User;

class LevelRepository {
  public function getLevel (User $user) {
    return Level::where('user_id', $user->id)->get();
  }
}