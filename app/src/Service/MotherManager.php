<?php declare(strict_types = 1);


namespace App\Service;


use App\Model\Mother;
use App\Model\MotherIdentifier;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class MotherManager implements MotherManagerInterface
{

    private $kernel;

    public function __construct(ObjectNormalizer $normalizer, KernelInterface $kernel)
    {
        $this->kernel = $kernel;
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

        // We can't use an injected Serializer service, as it will cause
        // a recursive reference from \App\Serializer\Normalizer\MotherIdentifierDenormalizer
        $encoders = [new YamlEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $iterator = $finder->getIterator();
        $iterator->rewind();
        $data = $iterator->current()->getContents();

        foreach ($finder as $file) {
            // Return on the first file.
            return $serializer->deserialize($data, MotherIdentifier::class, 'yaml');
        }
    }


    public function getFull(string $id): ?Mother
    {
        // TODO: Implement getFull() method.
    }
}