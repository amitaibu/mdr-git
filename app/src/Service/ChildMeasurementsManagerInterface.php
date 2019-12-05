<?php declare(strict_types = 1);


namespace App\Service;


use App\Entity\ChildMeasurements;

interface ChildMeasurementsManagerInterface
{

    public function get(string $fileId);

    public function create(string $childFileId, string $fileId, ChildMeasurements $childMeasurements);

}