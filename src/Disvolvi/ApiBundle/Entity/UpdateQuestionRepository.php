<?php

namespace Disvolvi\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UpdateQuestionRepository
 */
class UpdateQuestionRepository extends EntityRepository
{
    /**
     * Get last update
     *
     * Get the last time questions were updated in databse
     *
     * @return UnixTimestamp;
     */
    public function getLastUpdate()
    {
        $updateQuestion = $this->_em
            ->getRepository('DisvolviApiBundle:UpdateQuestion')
            ->createQueryBuilder('q')
            ->orderBy('q.id','desc')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        if (!$updateQuestion)
            return false;

        return $updateQuestion->getDate()->getTimestamp();
    }
}
