<?php

namespace Disvolvi\ApiBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Disvolvi\ApiBundle\Entity\Question;

class QuestionEntityTest extends WebTestCase
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

        $question = new Question();
        $question->setQuestionId(982364038);
        $question->setTitle('How do I test an Symfony2 application?');
        $question->setOwnerName('Bruno Almeida');
        $question->setScore(1);
        $question->setCreationDate(1437405249);
        $question->setLink('http://google.com.br/');
        $question->setIsAnswered(false);

        $errors = $validator->validate($question);
        $this->assertTrue(count($errors) == 0);
    }

    public function testInvalidEntityWithoutTitle()
    {
        $validator = static::$kernel->getContainer()->get('validator');

        $question = new Question();
        $question->setQuestionId(982364038);
        $question->setOwnerName('Bruno Almeida');
        $question->setScore(1);
        $question->setCreationDate(1437405249);
        $question->setLink('http://google.com.br/');
        $question->setIsAnswered(true);

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
