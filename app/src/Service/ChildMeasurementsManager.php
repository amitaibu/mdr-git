<?php


namespace App\Service;


use App\Model\ChildMeasurements;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ChildMeasurementsManager implements ChildMeasurementsManagerInterface
{

    private $serializer;
    private $kernel;

    public function __construct(SerializerInterface $serializer, KernelInterface $kernel)
    {
        $this->serializer = $serializer;
        $this->kernel = $kernel;
    }


    public function get(string $fileId)
    {
        $filesystem = new Filesystem();

        $path = $this->kernel->getProjectDir() . '/../data/children/' . $fileId . '/measurements';

        if (!$filesystem->exists($path)) {
            return null;
        }

        $finder = new Finder();
        $finder
          ->files()
          ->in($path . '/*/')
          ->name('data.yaml');

        if (!$finder->hasResults()) {
            return null;
        }

        $childrenMeasurements = [];

        foreach ($finder as $file) {
            $childMeasurements = $this->serializer->deserialize($file->getContents(), ChildMeasurements::class, 'yaml');

            // Add the File ID.
            $path = $file->getFileInfo()->getPath();
            $pathExploded = explode('/', $file->getFileInfo()->getPath());
            $fileId = end($pathExploded);
            $childMeasurements->setFileId($fileId);

            // Check if a photo exists, and if so, mark as true.
            $photo = $filesystem->exists($path . '/photo.png') ? $path . '/photo.png' : null;

            $photo = null;
            if ($filesystem->exists($path . '/photo.png')) {
                // To serve this image we need to temporarily copy it
                // to be under `public`.
                $target = 'child/photos/' . $fileId . '.png';
                $filesystem->copy($path . '/photo.png', $target, true);
                $package = new Package(new EmptyVersionStrategy());

                // Absolute path
                $photo = $package->getUrl('/' . $target);
            }

            $childMeasurements->setPhoto($photo);

            $childrenMeasurements[] = $childMeasurements;
        }

        return $childrenMeasurements;

    }
}