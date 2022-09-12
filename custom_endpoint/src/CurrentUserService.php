<?php

namespace Drupal\custom_endpoint;

class CurrentUserService {

  public function __construct(AccountInterface $currentUser): AccountProxy {
    $currentUser = $this->container()->get('current_user');
  }

  /**
   * Return current user data
   * or return an error message.
   */
  public function getResults($currentUser): array {
    //Try to get user data
    try {
      $username = $currentUser->getAccountName();
      $created = $currentUser->get['created'];
      $moddate = $currentUser->getLastAccessedTime();
      $lastlogon = $currentUser->getLastAccessedTime();

      if ($username == "") {
        return "You are not logged in.";
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
