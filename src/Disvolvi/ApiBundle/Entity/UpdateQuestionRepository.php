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
        if (!$updateQuestion = $this->_em->getRepository('DisvolviApiBundle:UpdateQuestion'))
            return false;

        return $updateQuestion->getDate()->getTimestamp();
    }
}
