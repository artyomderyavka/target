<?php


namespace Target\Components;


use FastMicroKernel\Components\ServiceClientInterface;
use FastMicroKernel\Components\ServiceRequestBuilderInterface;

class Service
{
    protected $contentServiceClient;
    protected $requestBuilder;

    public function __construct(
        ServiceClientInterface $contentServiceClient,
        ServiceRequestBuilderInterface $requestBuilder
    )
    {
        $this->contentServiceClient = $contentServiceClient;
        $this->requestBuilder = $requestBuilder;
    }

    public function getTarget()
    {
        $response = new \StdClass();
        $response->messageFromTarget = "response from target";

        $request = $this->requestBuilder->buildRequest('GET', '/');
        $responseFromContentJson = $this->contentServiceClient
            ->makeRequest($request)
            ->getBody()
            ->getContents();
        $responseFromContent = json_decode($responseFromContentJson);
        $response->messageFromContent = $responseFromContent->message;
        return $response;
    }
}