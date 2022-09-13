<?php

namespace Drupal\custom_endpoint\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Timestamp Users class
 */
class TimestampUsersController extends ControllerBase {

  function renderApi(): JsonResponse {
    return new JsonResponse([
      'Test' => 'Test message'
    ]);
  }

}
