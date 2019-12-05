<?php declare(strict_types = 1);


namespace App\Service;


interface ChildMeasurementsManagerInterface
{

    public function get(string $fileId);

}