<?php

namespace Drupal\custom_endpoint\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\custom_endpoint\TimestampUserService;

/**
 * Timestamp Users class
 */
class TimestampUsersController extends ControllerBase {

  protected $timestamp_user_service;

  /**
   * The current user service.
   *
   * @param \Drupal\custom_endpoint\CurrentUserService $current_user
   */
  public function __construct(TimestampUserService $timestamp_user_service) {
    $this->$timestamp_user_service = $timestamp_user_service;
  }

  public static function create(ContainerInterface $container): TimestampUsersController {
    return new static(
      $container->get('custom_endpoint.timestamp_users_service')
    );
  }

  function renderApi(Request $request): JsonResponse {

    $start_date = $request->get('start_date');
    $end_date = $request->get('end_date');

    return new JsonResponse([
      'Start date' => $start_date,
      'End date' => $end_date
    ]);
  }

}
