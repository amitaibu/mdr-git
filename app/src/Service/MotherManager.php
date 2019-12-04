<?php declare(strict_types = 1);


namespace App\Service;


use App\Model\Mother;
use App\Model\MotherIdentifier;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\SerializerInterface;

class MotherManager implements MotherManagerInterface
{

    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }


    public function getIdentifier(string $id): ?string
    {

        $finder = new Finder();
        $finder
          ->files()
          ->in($this->kernel->getProjectDir() . '/../data/mothers/' . $id)
          ->name('id.yaml');

        if (!$finder->hasResults()) {
            return null;
        }

        foreach ($finder as $file) {
            return $file->getContents();
        }
    }


    public function getFull(string $id): ?string
    {
        // TODO: Implement getFull() method.
    }
}