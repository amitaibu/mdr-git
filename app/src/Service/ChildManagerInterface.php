<?php declare(strict_types = 1);


namespace App\Service;


use App\Entity\Child;
use App\Entity\ChildIdentifier;

interface ChildManagerInterface
{

    public function getIdentifier(string $fileName) : ?ChildIdentifier;

    public function get(string $fileName) : ?Child;

}