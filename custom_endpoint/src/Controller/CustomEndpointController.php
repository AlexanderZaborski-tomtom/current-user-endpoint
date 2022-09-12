<?php

namespace Drupal\custom_endpoint\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\custom_endpoint\CurrentUserService;

/**
 * Custom Endpoint Controller class
 */
class CustomEndpointController extends ControllerBase {

  /**
   * Custom Endpoint controller constructor
   *
   * @param \Drupal\Core\Session\AccountInterface
   */
  public function __construct(CurrentUserService $currentUser) {
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
      'data' => $container->getResults($this->currentUser),
      'method' => 'GET',
    ]);
  }

}
