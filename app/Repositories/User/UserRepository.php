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

  public function getUserByEmail ($email) {
    return User::where('email', $email)->get();
  }

  public function getUserByIdAndSearch($userId, $string) {
    return User::where('id', $userId)->where('name', 'like', $string)->get();
  }
}