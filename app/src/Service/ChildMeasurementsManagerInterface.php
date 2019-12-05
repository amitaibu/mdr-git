<?php declare(strict_types = 1);


namespace App\Service;


use App\Model\Child;
use App\Model\ChildIdentifier;
use App\Model\ChildMeasurements;

interface ChildMeasurementsManagerInterface
{

    public function get(string $fileId);

}