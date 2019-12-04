<?php declare(strict_types = 1);


namespace App\Service;


use App\Model\Mother;
use App\Model\MotherIdentifier;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class MotherManager implements MotherManagerInterface
{

    private $kernel;
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer, KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $this->normalizer = $normalizer;
    }


    public function getIdentifier(string $id): ?MotherIdentifier
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
            return $this->normalizer->denormalize($file->getContents(), MotherIdentifier::class, 'yaml');
        }
    }


    public function getFull(string $id): ?Mother
    {
        // TODO: Implement getFull() method.
    }
}