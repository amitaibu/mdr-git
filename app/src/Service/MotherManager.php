<?php declare(strict_types = 1);


namespace App\Service;

use App\Entity\Mother;
use App\Entity\MotherIdentifier;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Yaml\Yaml;

class MotherManager implements MotherManagerInterface
{

    private $kernel;
    private $childManager;

    public function __construct(KernelInterface $kernel, ChildManagerInterface $childManager)
    {
        $this->kernel = $kernel;
        $this->childManager = $childManager;
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
            $motherData = Yaml::parse($motherFileContent);

            $mother = $serializer->denormalize($motherData, $className);

            $path = explode('/', $file->getFileInfo()->getPath());
            $fileId = end($path);
            $mother->setFileId($fileId);

            if (MotherIdentifier::class === $className) {
                $this->addChildrenIdentifiers($mother, $motherData);
            }
            // @todo: How to get Symfony to do this for us?
            elseif (Mother::class === $className) {
                $motherIdentifier = $serializer->denormalize($motherData, MotherIdentifier::class);
                $motherIdentifier->setFileId($fileId);
                $this->addChildrenIdentifiers($motherIdentifier, $motherData);

                $mother->setIdentifier($motherIdentifier);
            }

            return $mother;
        }
    }

    private function addChildrenIdentifiers(MotherIdentifier $motherIdentifier, array $motherData) {
        $childrenIdentifiers = [];
        foreach ($motherData['children'] as $childFileId) {
            $childrenIdentifiers[] = $this->childManager->getIdentifier($childFileId);
        }

        $motherIdentifier->setChildrenIdentifiers($childrenIdentifiers);
    }

}