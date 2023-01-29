<?php

namespace App\Service;

use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Response;

class JsonResponse extends Response
{
	public function __construct(public SerializerInterface $serializer) {}

	public function json($content, $groups = ""): Response {
		return new Response($this->serializer->serialize($content, "json", SerializationContext::create()->setGroups([$groups])), $content['status_code'], ['Content-Type' => "application/json"]);
	}
}
