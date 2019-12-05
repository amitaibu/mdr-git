<?php declare(strict_types = 1);


namespace App\Service;


use App\Model\Child;
use App\Model\ChildIdentifier;
use Symfony\Component\HttpKernel\KernelInterface;

class ChildManager implements ChildManagerInterface
{

    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
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
            $mother = $serializer->deserialize($file->getContents(), $className, 'yaml');
            $path = explode('/', $file->getFileInfo()->getPath());
            $fileId = end($path);

            $mother->setFileId($fileId);

            // @todo: How to get Symfony to do this for us?
            if (Child::class === $className) {
                $motherIdentifier = $serializer->deserialize($file->getContents(), ChildIdentifier::class, 'yaml');
                $mother->setIdentifier($motherIdentifier);
            }

            return $mother;
        }
    }
}