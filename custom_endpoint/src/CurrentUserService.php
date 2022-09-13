<?php

namespace Drupal\custom_endpoint;

use Drupal\Core\Session\AccountInterface;

class CurrentUserService {

  protected $currentUser;

  /**
   * Custom endpoint service controller
   *
   * @param \Drupal\Core\Session\AccountInterface
   */
  public function __construct(AccountInterface $current_user) {
    $this->currentUser = $current_user;
  }

  /**
   * Return current user data
   * or return an error message.
   */
  public function getResults(): array {
    //Try to get user data
    try {
      $username = $this->currentUser->getAccountName();
      $created = $this->currentUser->get['created'];
      $moddate = $this->currentUser->getLastAccessedTime();
      $lastlogon = $this->currentUser->getLastAccessedTime();

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
