<?php declare(strict_types = 1);


namespace App\Service;


use App\Model\Child;
use App\Model\ChildIdentifier;

interface ChildManagerInterface
{

    public function getIdentifier(string $fileName) : ?ChildIdentifier;

    public function get(string $fileName) : ?Child;

}