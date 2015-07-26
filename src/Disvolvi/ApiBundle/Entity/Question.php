<?php

namespace Disvolvi\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation as JMS,
    JMS\Serializer\Annotation\Groups,
    JMS\Serializer\Annotation\VirtualProperty,
    JMS\Serializer\Annotation\Type,
    JMS\Serializer\Annotation\SerializedName;

/**
 * Question
 *
 * @ORM\Table("questions")
 * @ORM\Entity(repositoryClass="Disvolvi\ApiBundle\Entity\QuestionRepository")
 */
class Question
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="questionId", type="integer")
     * @JMS\Groups({"question"})
     * @Assert\NotBlank(message="Required field")
     */
    private $questionId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @JMS\Groups({"question"})
     * @Assert\NotBlank(message="Required field")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="ownerName", type="string", length=255)
     * @JMS\Groups({"question"})
     * @Assert\NotBlank(message="Required field")
     */
    private $ownerName;

    /**
     * @var integer
     *
     * @ORM\Column(name="score", type="integer")
     * @JMS\Groups({"question"})
     * @Assert\NotBlank(message="Required field")
     */
    private $score;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     * @Assert\NotBlank(message="Required field")
     */
    private $creationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255)
     * @JMS\Groups({"question"})
     * @Assert\NotBlank(message="Required field")
     */
    private $link;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isAnswered", type="boolean")
     * @JMS\Groups({"question"})
     */
    private $isAnswered;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }/**
     * @VirtualProperty
     * @Type("integer")
     * @SerializedName("creation_date")
     * @Groups({"question"})
     */
    public function getCreationDateTimestamp()
    {
        return $this->creationDate->getTimestamp();
    }

    /**
     * Set questionId
     *
     * @param integer $questionId
     * @return Question
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * Get questionId
     *
     * @return integer
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Question
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set ownerName
     *
     * @param string $ownerName
     * @return Question
     */
    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;

        return $this;
    }

    /**
     * Get ownerName
     *
     * @return string
     */
    public function getOwnerName()
    {
        return $this->ownerName;
    }

    /**
     * Set score
     *
     * @param integer $score
     * @return Question
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Question
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Question
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set isAnswered
     *
     * @param boolean $isAnswered
     * @return Question
     */
    public function setIsAnswered($isAnswered)
    {
        $this->isAnswered = $isAnswered;

        return $this;
    }

    /**
     * Get isAnswered
     *
     * @return boolean
     */
    public function getIsAnswered()
    {
        return $this->isAnswered;
    }
}
