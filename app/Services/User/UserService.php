<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;

class UserService {
  private $userRepository;
  
  public function __construct (UserRepository $userRepository) {
    $this->userRepository = $userRepository;
  }

  public function getLicense ($userId) {
    return $this->userRepository->getLicense($userId);
  }

  public function getUserById ($userId) {
    return $this->userRepository->getUserById($userId);
  }
}