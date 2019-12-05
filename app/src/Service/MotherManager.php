<?php declare(strict_types = 1);


namespace App\Service;

use App\Model\ChildIdentifier;
use App\Model\Mother;
use App\Model\MotherIdentifier;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MotherManager implements MotherManagerInterface
{

    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }


    public function getIdentifier(string $fileName): ?MotherIdentifier
    {

        return $this->getByClass($fileName, MotherIdentifier::class);
    }


    public function get(string $fileName): ?Mother

    {

        return $this->getByClass($fileName, Mother::class);

    }

    private function getByClass(string $fileId, $className) {
        $filesystem = new Filesystem();

        $path = $this->kernel->getProjectDir() . '/../data/mothers/' . $fileId;

        if (!$filesystem->exists($path)) {
            return null;
        }

        $finder = new Finder();
        $finder
          ->files()
          ->in($path)
          ->name('id.yaml');

        if (!$finder->hasResults()) {
            return null;
        }

        // We can't use an injected Serializer service, as it will cause
        // a recursive reference from \App\Serializer\Normalizer\MotherIdentifierDenormalizer
        $encoders = [new YamlEncoder()];
        $normalizers = [new ObjectNormalizer()];

         $serializer = new Serializer($normalizers, $encoders);


        // Return on the first file.
        foreach ($finder as $file) {

            $motherFileContent = $file->getContents();

            $mother = $serializer->deserialize($motherFileContent, $className, 'yaml');

            $path = explode('/', $file->getFileInfo()->getPath());
            $fileId = end($path);
            $mother->setFileId($fileId);

            // @todo: How to get Symfony to do this for us?
            if (Mother::class === $className) {
                $motherIdentifier = $serializer->deserialize($motherFileContent, MotherIdentifier::class, 'yaml');
                $motherIdentifier->setFileId($fileId);
                $mother->setIdentifier($motherIdentifier);
            }

            return $mother;
        }
    }
}