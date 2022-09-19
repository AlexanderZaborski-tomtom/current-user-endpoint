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
class CurrentUserController extends ControllerBase {

  /**
   * Variable to store the Current User service
   *
   * @var \Drupal\custom_endpoint\CurrentUserService
   */
  private $current_user_service;

  /**
   * The current user service.
   *
   * @param \Drupal\custom_endpoint\CurrentUserService $current_user
   */
  public function __construct(CurrentUserService $current_user) {
    $this->current_user_service = $current_user;
  }

  /**
   * Gets the current user service
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface;
   */
  public static function create(ContainerInterface $container): CurrentUserController {
    return new static(
      $container->get('custom_endpoint.current_user_service')
    );
  }

  /**
   * @return JsonResponse with user data
   *
   * @param \Symfony\Component\HttpFoundation\JsonResponse
   */
  public function renderApi(): JsonResponse {

    return new JsonResponse([
      'data' => $this->current_user_service->getResults(),
      'method' => 'GET',
    ]);
  }

}
