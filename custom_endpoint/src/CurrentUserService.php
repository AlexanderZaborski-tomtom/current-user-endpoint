<?php

namespace Drupal\custom_endpoint;

use Drupal\Core\Session\AccountInterface;

/**
 * Custom Endpoint Service class
 */
class CurrentUserService {

  /**
   * Variable to store the current user
   * @var type \Drupal\Core\Session\AccountInterface
   */
  protected $current_user;

  /**
   * Custom endpoint service controller
   *
   * @param \Drupal\Core\Session\AccountInterface
   */
  public function __construct(AccountInterface $current_user) {
    $this->current_user = $current_user;
  }

  /**
   * Return current user data
   * or return an error message.
   */
  public function getResults(): array {
    //Try to get user data
    try {
      $username = $this->current_user->getAccountName();
      $created = $this->current_user->get['created']->value;
      $moddate = $this->current_user->getLastAccessedTime();
      $lastlogon = $this->current_user->getLastAccessedTime();

      if ($username == '') {
        return [
          "error" => "You are not logged in",
        ];
      }
      else {
        //user data output
        return [
          [
            "username" => $username,
            "created" => date("d F Y H:i:s", $created),
            "moddate" => date("d F Y H:i:s", $moddate),
            "lastlogon" => date("d F Y H:i:s", $lastlogon),
          ],
        ];
      }
    }
    //Return error message
    catch (\Throwable $th) {
      //throw $th;
      return [
        "error" => $th->getMessage(),
      ];
    }
  }

}
