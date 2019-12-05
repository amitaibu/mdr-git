<?php


namespace App\Model;


use Symfony\Component\Serializer\Annotation\SerializedName;

class ChildMeasurements
{

    private $fileId;
    private $weight;
    private $height;
    private $photo;

    /**
     * @var string
     *
     * @SerializedName("group_meeting")
     */
    private $groupMeeting;

    /**
     * @return mixed
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * @param mixed $fileId
     */
    public function setFileId($fileId): void
    {
        $this->fileId = $fileId;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getGroupMeeting()
    {
        return $this->groupMeeting;
    }

    /**
     * @param mixed $groupMeeting
     */
    public function setGroupMeeting($groupMeeting): void
    {
        $this->groupMeeting = $groupMeeting;
    }


}