<?php

namespace Disvolvi\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response;

class AjaxController extends Controller
{

    /**
     * Update Action
     *
     * Update the last 99 questions
     *
     * @return json;
     */
    public function updateAction()
    {
        $em = $this->getDoctrine()->getManager();

        $url = $this->container->getParameter('api_url') . 'questions';
        $response = $this->get('disvolvi.call_api')->get($url, array(
            'site' => 'stackoverflow',
            'page' => 1,
            'pagesize' => 99,
            'order' => 'desc',
            'sort' => 'creation',
            'tagged' => 'php',
        ));

        $return = $em->getRepository('DisvolviApiBundle:Question')
                        ->updateQuestions($response->items);

        $response = $return ? new Response('Created', 201) :
                              new Response('Error', 500);
        return $response;

    }
}
