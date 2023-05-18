<?php

namespace App\Repositories\User;

class UserRepository {
  public function getLicense ($userId) {
    return User::find($userId)->status;
  }
}