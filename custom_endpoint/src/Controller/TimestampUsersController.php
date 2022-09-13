<?php

namespace Drupal\custom_endpoint\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Timestamp Users class
 */
class TimestampUsersController extends ControllerBase {

  private $start_date;
  private $end_date;

  function renderApi(Request $request): JsonResponse {

    $start_date = $request->get('start_date');
    $end_date = $request->get('end_date');

    return new JsonResponse([
      'Start date' => $start_date,
      'End date' => $end_date
    ]);
  }

}
