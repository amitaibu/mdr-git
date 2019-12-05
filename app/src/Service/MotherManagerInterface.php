<?php declare(strict_types = 1);


namespace App\Service;


use App\Model\Mother;
use App\Model\MotherIdentifier;

interface MotherManagerInterface
{

    public function getIdentifier(string $fileName) : ?MotherIdentifier;

    public function get(string $fileName) : ?Mother;

}