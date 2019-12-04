<?php


namespace App\Model;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\SerializedName;

class GroupMeeting
{


    private $name;
    private $date;

    /**
     * @var \App\Model\MotherIdentifier[] | ArrayCollection
     *
     * @SerializedName("mothers")
     */
    private $motherIdentifiers;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getMotherIdentifiers()
    {
        return $this->motherIdentifiers;
    }

    /**
     * @param mixed $motherIdentifiers
     */
    public function setMotherIdentifiers($motherIdentifiers): void
    {
        $this->motherIdentifiers = $motherIdentifiers;
    }


}