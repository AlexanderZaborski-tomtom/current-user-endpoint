<?php

namespace Drupal\custom_endpoint;

use \Drupal\Core\Entity\EntityTypeManager;

/**
 * Service class for timestamp users
 */
class TimestampUserService {

  protected $timestamp_users;

  public function __construct(EntityTypeManager $timestamp_users) {
    $this->timestamp_users = $timestamp_users;
  }

  public function getUsers(): array {
    try {
      $users = entity_load('user');
      foreach ($users as $user) {
        echo $user;
      }
    }
    catch (\Throwable $th) {
      return [
        'error' => $th->getMessage(),
      ];
    }
  }

}
