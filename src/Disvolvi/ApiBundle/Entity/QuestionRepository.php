<?php

namespace Disvolvi\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\HttpFoundation\Request;

use Disvolvi\ApiBundle\Entity\Question,
    Disvolvi\ApiBundle\Entity\UpdateQuestion;

class QuestionRepository extends EntityRepository
{
    /**
     * Update Questions
     *
     * Persist the questions in the database
     *
     * @param Array $questions
     *
     * @return boolean;
     */
    public function updateQuestions($questions)
    {
        foreach ($questions as $_question) {

            try {

              $question = $this->_em
                            ->getRepository('DisvolviApiBundle:Question')
                            ->findOneByQuestionId($_question->question_id);

                if (!$question)
                    $question = new Question();

                $date = new \DateTime();
                $creation_date = $date->setTimestamp($_question->creation_date);

                $question
                    ->setQuestionId($_question->question_id)
                    ->setTitle($_question->title)
                    ->setOwnerName($_question->owner->display_name)
                    ->setScore($_question->score)
                    ->setCreationDate($creation_date)
                    ->setLink($_question->link)
                    ->setIsAnswered($_question->is_answered);

                $this->_em->persist($question);
                $this->_em->flush();
            } catch (Exception $e) {

                return false;
            }
        }

        $updateQuestion = new UpdateQuestion();
        $updateQuestion->setDate(new \DateTime());

        $this->_em->persist($updateQuestion);
        $this->_em->flush();

        return true;
    }

    /**
     * Find per page
     *
     * @param Symfony\Component\HttpFoundation\Request $request
     * @param Service $paginator
     * @param integer $page
     * @param integer $rpp
     *
     * @return array
     */
    public function findPerPage(Request $request, $paginator)
    {
        $page = $request->query->get('page', 1);
        $rpp = $request->query->get('rpp', 15);
        
        $query = $this->_em->getRepository('DisvolviApiBundle:Question')
                            ->createQueryBuilder('q');

        return $paginator->paginate(
            $query,
            $page,
            $rpp
        )->getItems();
    }
}
