<?php

namespace Disvolvi\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

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
        foreach ($questions as $question) {

            try {

                if (!$entity = $this->_em->getRepository('DisvolviApiBundle:Question')->findOneByQuestionId($question->question_id))
                    $entity = new Question();

                $date = new \DateTime();
                $creation_date = $date->setTimestamp($question->creation_date);

                $entity
                    ->setQuestionId($question->question_id)
                    ->setTitle($question->title)
                    ->setOwnerName($question->owner->display_name)
                    ->setScore($question->score)
                    ->setCreationDate($creation_date)
                    ->setLink($question->link)
                    ->setIsAnswered($question->is_answered);

                $this->_em->persist($entity);
                $this->_em->flush();
            } catch (Exception $e) {

                return false;
            }
        }

        return true;
    }
}
