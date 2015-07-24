<?php

namespace Disvolvi\ApiBundle\Controller\V1;

use Symfony\Component\HttpFoundation\Request;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Disvolvi\ApiBundle\Controller\V1\RestController;

class QuestionController extends RestController
{
    /**
     * Get question
     *
     * @ApiDoc(
     *  description="List question with the tag PHP from StackOverflow",
     *  parameters={
     *      {"name"="page", "dataType"="integer", "required"=false, "description"="Page"},
     *      {"name"="rpp", "dataType"="integer", "required"=false, "description"="Results per page"},
     *      {"name"="sort", "dataType"="string", "required"=false, "description"="Sort property"},
     *      {"name"="score", "dataType"="integer", "required"=false, "description"="Score bigger than"}
     *  }
     * )
     *
     * @return json
     */
    public function getQuestionAction(Request $request)
    {
        return $this->getIndexAction(
            $request,
            'Question',
            array('question')
        );
    }

    /**
     * Get question
     *
     * @ApiDoc(
     *  description="Update the last 99 qustions"
     * )
     *
     * @return json
     */
    public function getUpdateQuestionsAction()
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

        if($return) {
            return $this->view(array('update' => true), 200);
        } else {
            return $this->view(array('update' => false), 500);
        }
    }
}
