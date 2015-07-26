<?php

namespace Disvolvi\ApiBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Disvolvi\ApiBundle\Entity\UpdateQuestion;

class QuestionUpdateEntityTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testValidEntity()
    {
        $validator = static::$kernel->getContainer()->get('validator');

        $question = new UpdateQuestion();
        $question->setDate(new \DateTime());

        $errors = $validator->validate($question);
        $this->assertTrue(count($errors) == 0);
    }

    public function testInvalidEntityWithoutTitle()
    {
        $validator = static::$kernel->getContainer()->get('validator');

        $question = new UpdateQuestion();

        $errors = $validator->validate($question);
        $this->assertTrue(count($errors) > 0);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }
}
