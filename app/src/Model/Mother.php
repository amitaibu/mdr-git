<?php


namespace App\Model;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Class Mother
 *
 * Hold the full Mother data.
 *
 * @package App\Model
 */
class Mother
{

    private $fileId;

    /**
     * @var \App\Model\MotherIdentifier
     */
    private $identifier;

    /**
     * @var bool
     *
     * @SerializedName("birthday_estiamted")
     */
    private $birthdayEstimated;

    /**
     * @return \App\Model\MotherIdentifier
     */
    public function getIdentifier(): \App\Model\MotherIdentifier
    {
        return $this->identifier;
    }

    /**
     * @param \App\Model\MotherIdentifier $identifier
     */
    public function setIdentifier(\App\Model\MotherIdentifier $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return bool
     */
    public function isBirthdayEstimated(): bool
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