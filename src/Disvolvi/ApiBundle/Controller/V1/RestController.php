<?php

namespace Disvolvi\ApiBundle\Controller\V1;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\FOSRestController,
    FOS\RestBundle\View\View;

use JMS\Serializer\SerializationContext,
    JMS\Serializer\SerializerBuilder;

class RestController extends FOSRestController
{

    /**
     *
     * @param Symfony\Component\HttpFoundation\Request $request
     * @param string $entity Entity
     * @param array $groups Group to serialize
     *
     * @return json
     */
    protected function getIndexAction(Request $request, $entity, $groups)
    {
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');

        $questions = $em->getRepository("DisvolviApiBundle:{$entity}")
            ->findPerPage($request, $paginator);

        if (count($questions) == 0)
            return $this->view('No records found', 404);

        if (isset($questions['error']))
            return $this->view($questions, 400);

        $data = array(
            'last_update' => $em->getRepository("DisvolviApiBundle:UpdateQuestion")->getLastUpdate(),
            'content' => $questions
        );

        return $this->serialize($data, $groups, 200);
    }

    /**
     * @param array $data
     * @param array $groups
     * @param int $response Response session_status
     *
     * @return json
     */
    private function serialize($data, $groups, $response = 200)
    {
        $serializer = SerializerBuilder::create()->build();
        $data = $serializer->serialize(
            $data,
            'json',
            SerializationContext::create()->setGroups($groups)
        );
        return $this->view(json_decode($data, true), $response);
    }
}
