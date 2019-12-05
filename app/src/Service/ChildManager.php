<?php declare(strict_types = 1);


namespace App\Service;


use App\Entity\Child;
use App\Entity\ChildIdentifier;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ChildManager implements ChildManagerInterface
{

    private $kernel;
    private $childMeasurementsManager;

    public function __construct(KernelInterface $kernel, ChildMeasurementsManagerInterface $childMeasurementsManager)
    {
        $this->kernel = $kernel;
        $this->childMeasurementsManager = $childMeasurementsManager;
    }


    public function getIdentifier(string $fileName): ?ChildIdentifier
    {

        return $this->getByClass($fileName, ChildIdentifier::class);
    }


    public function get(string $fileName): ?Child

    {

        return $this->getByClass($fileName, Child::class);

    }

    private function getByClass(string $fileId, $className) {
        $finder = new Finder();
        $finder
          ->files()
          ->in($this->kernel->getProjectDir() . '/../data/children/' . $fileId)
          ->name('id.yaml');

        if (!$finder->hasResults()) {
            return null;
        }

        // We can't use an injected Serializer service, as it will cause
        // a recursive reference from \App\Serializer\Normalizer\MotherIdentifierDenormalizer
        $encoders = [new YamlEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        foreach ($finder as $file) {
            // Return on the first file.

            $fileContents = $file->getContents();

            $child = $serializer->deserialize($fileContents, $className, 'yaml');
            $path = explode('/', $file->getFileInfo()->getPath());
            $fileId = end($path);

            $child->setFileId($fileId);

            // @todo: How to get Symfony to do this for us?
            if (Child::class === $className) {
                /** @var ChildIdentifier $childIdentifier */
                $childIdentifier = $serializer->deserialize($fileContents, ChildIdentifier::class, 'yaml');
                $childIdentifier->setFileId($fileId);

                $child->setIdentifier($childIdentifier);

                // Add measurements
                $measurements = $this->childMeasurementsManager->get($fileId);
                $child->setMeasurements($measurements);
            }

            return $child;
        }
    }

}