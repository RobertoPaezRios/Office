<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository {
  public function getLicense ($userId) {
    return User::find($userId)->status;
  }

  public function getUserById($userId) {
    return User::find($userId);
  }
}