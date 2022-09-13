<?php

namespace Drupal\custom_endpoint\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Timestamp Users class
 */
class TimestampUsersController extends ControllerBase {

  function renderApi(): JsonResponse {
    $start_date = \Drupal::routeMatch()->getRawParameter('start_date');
    $end_date = \Drupal::routeMatch()->getRawParameter('end_date');

    return new JsonResponse([
      'Start date' => $start_date,
      'End date' => $end_date
    ]);
  }

}
