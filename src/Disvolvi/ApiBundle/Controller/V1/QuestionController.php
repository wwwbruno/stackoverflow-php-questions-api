<?php

namespace Disvolvi\ApiBundle\Controller\V1;

use Symfony\Component\HttpFoundation\Request;

use Disvolvi\ApiBundle\Controller\V1\RestController;

class QuestionController extends RestController
{
    /**
     * Get question
     *
     * @return json
     */
    public function getQuestionAction(Request $request)
    {
        $page = $request->query->get('page', 1);
        $rpp = $request->query->get('rpp', 15);

        return $this->getIndexAction(
            $request,
            'Question',
            array('question'),
            $page,
            $rpp
        );
    }
}
