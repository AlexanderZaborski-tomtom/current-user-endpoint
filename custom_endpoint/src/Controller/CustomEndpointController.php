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
   * @param AccountInterface $currentUserClass constructor
   */
  public function __construct(AccountInterface $currentUser) {
    $this->currentUser = $currentUser;
  }

  /**
   * Gets the current user
   */
  public static function create(ContainerInterface $container): CustomEndpointController {
    return new static(
      $container->get('current_user'),
    );
  }

  /**
   * @return JsonResponse
   */
  public function renderApi(): JsonResponse {

    $currentUserService = \Drupal::service('custom_endpoint.currentUser');
    return new JsonResponse([
      'data' => $currentUserService->getResults($this->currentUser),
      'method' => 'GET',
    ]);
  }

}
