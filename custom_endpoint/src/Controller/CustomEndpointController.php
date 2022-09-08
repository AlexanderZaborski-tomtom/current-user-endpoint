<?php

namespace Drupal\custom_endpoint\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Custom Endpoint Controller class
 */

class CustomEndpointController extends ControllerBase {

    /**
    *
    * @param AccountInterface $currentUserClass constructor
    */
    public function __construct(AccountInterface $currentUser) {
      $this->currentUser = $currentUser;
    }

    /**
    * Gets the current user
    */
    public static function create(ContainerInterface $container) {
      return new static(
        $container->get('current_user'),
      );
    }

    /**
    * @return JsonResponse
    */
    public function renderApi() : JsonResponse {
      return new JsonResponse([
        'data' => $this->getResults(),
        'method' => 'GET',
      ]);
    }

    /**
    * Get current user data
    * or return an error message
    */
    public function getResults() {

      //Try to get user data
      try {
         $username = $this->currentUser->getAccountName();
         //$created = $this->currentUser->get('created')->getValue();
         $created = $this->currentUser->get['created'];
         $moddate = $this->currentUser->getLastAccessedTime();
         $lastlogon = $this->currentUser->getLastAccessedTime();

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

