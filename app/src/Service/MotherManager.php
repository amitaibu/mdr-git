<?php declare(strict_types = 1);


namespace App\Service;


use App\Model\GroupMeeting;
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

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }


    public function getIdentifier(string $fileName): ?MotherIdentifier
    {

        return $this->getMotherByClass($fileName, MotherIdentifier::class);
    }


    public function getFull(string $fileName): ?Mother

    {

        return $this->getMotherByClass($fileName, Mother::class);

    }

    private function getMotherByClass(string $fileId, $className) {
        $finder = new Finder();
        $finder
          ->files()
          ->in($this->kernel->getProjectDir() . '/../data/mothers/' . $fileId)
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
            if (Mother::class === $className) {
                $motherIdentifier = $serializer->deserialize($file->getContents(), MotherIdentifier::class, 'yaml');
                $mother->setIdentifier($motherIdentifier);
            }

            return $mother;
        }
    }
}