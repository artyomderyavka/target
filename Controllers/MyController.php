<?php


namespace Target\Controllers;


use FastMicroKernel\Components\Controller;

class MyController extends Controller
{
    public function index() {
        $response = $this->getContainer()->get('targetService')->getTarget();
        return $this->buildJsonResponse(200, $response);
    }
}