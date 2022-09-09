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
   * Custom Endpoint controller constructor
   *
   * @param \Drupal\Core\Session\AccountInterface
   */
  public function __construct(AccountInterface $currentUser) {
    $this->currentUser = $currentUser;
  }

  /**
   * Gets the current user
   */
  public static function create(ContainerInterface $container): CustomEndpointController {
    return new static(
      $container->get('custom_endpoint.current_user_service')
    );
  }

  /**
   * @return JsonResponse with user data
   */
  public function renderApi(): JsonResponse {

    return new JsonResponse([
      'data' => $this->currentUserService->getResults($this->currentUser),
      'method' => 'GET',
    ]);
  }

}
