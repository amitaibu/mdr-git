<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Class Mother
 *
 * Hold the full Mother data.
 *
 * @package App\Entity
 */
class Mother
{

    private $fileId;

    /**
     * @var \App\Entity\MotherIdentifier
     */
    private $identifier;

    /**
     * @var bool
     *
     * @SerializedName("birthday_estiamted")
     */
    private $birthdayEstimated;

    /**
     * @return \App\Entity\MotherIdentifier
     */
    public function getIdentifier(): ?\App\Entity\MotherIdentifier
    {
        return $this->identifier;
    }

    /**
     * @param \App\Entity\MotherIdentifier $identifier
     */
    public function setIdentifier(\App\Entity\MotherIdentifier $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return bool
     */
    public function isBirthdayEstimated()
    {
        return $this->birthdayEstimated;
    }

    /**
     * @param bool $birthdayEstimated
     */
    public function setBirthdayEstimated(bool $birthdayEstimated): void
    {
        $this->birthdayEstimated = $birthdayEstimated;
    }

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

}