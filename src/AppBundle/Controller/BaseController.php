<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Base controller with shortcut methods.
 *
 * @author Dariusz Gołąbek <golabiusz@gmail.com>
 */
abstract class BaseController extends Controller
{
    /**
     * Successful JSON response.
     * @param array $data
     * @param integer $statusCode
     * @return JsonResponse
     */
    public function createJsonResponse(array $data, $statusCode = 200)
    {
        $response = array(
            'status' => $statusCode,
            'data' => $data
        );

        return new JsonResponse($response, $statusCode);
    }

    /**
     * Client error within JSON response.
     * @param string $message
     * @param integer $statusCode
     * @return JsonResponse
     */
    public function createClientError($message = 'app.client.error', $statusCode = 400)
    {
        $response = array(
            'status' => $statusCode,
            'message' => $this->getTranslator()->trans($message)
        );

        return new JsonResponse($response, $statusCode);
    }

    /**
     * Server error within JSON response.
     * @param string $message
     * @param integer $statusCode
     * @return JsonResponse
     */
    public function createServerError($message = 'app.server.error', $statusCode = 500)
    {
        $response = array(
            'status' => $statusCode,
            'message' => $this->getTranslator()->trans($message)
        );

        return new JsonResponse($response, $statusCode);
    }

    /**
     * Translator.
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    public function getTranslator()
    {
        return $this->get('translator');
    }
}
