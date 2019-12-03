<?php


namespace App\Model;


use Doctrine\Common\Collections\ArrayCollection;

class GroupMeeting
{


    private $name;
    private $date;

    /**
     * @var \App\Model\MotherPartial[] | ArrayCollection
     */
    private $mothers;

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
    public function getMothers()
    {
        return $this->mothers;
    }

    /**
     * @param mixed $mothers
     */
    public function setMothers($mothers): void
    {
        $this->mothers = $mothers;
    }


}