<?php

namespace Disvolvi\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

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
}
