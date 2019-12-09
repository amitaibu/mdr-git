<?php


namespace App\Service;


use App\Entity\ChildMeasurements;
use Cz\Git\GitRepository;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Yaml\Yaml;

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


            $photo = null;
            $extensions = ['jpg', 'png'];
            foreach ($extensions as $extension) {
                $fileName = 'photo.' . $extension;
                if ($filesystem->exists($path . '/' . $fileName)) {
                    // To serve this image we need to temporarily copy it
                    // to be under `public`.
                    $target = 'child/photos/' . $fileId . '.'  . $fileName;
                    $filesystem->copy($path . '/' . $fileName, $target, true);
                    $package = new Package(new EmptyVersionStrategy());

                    // Absolute path
                    $photo = $package->getUrl('/' . $target);

                    // We have an image.
                    break;
                }
            }


            $childMeasurements->setPhoto($photo);

            $childrenMeasurements[] = $childMeasurements;
        }

        return $childrenMeasurements;

    }

    public function create(string $childFileId, string $fileId, ChildMeasurements $childMeasurements)
    {
        $filesystem = new Filesystem();
        $path = $this->kernel->getProjectDir() . '/../data/children/' . $childFileId . '/measurements/' . $fileId . '/data.yaml';

        // @todo: Use encoder.
        $encoded = [
            'version' => 1,
            'group_meeting' => $childMeasurements->getGroupMeeting(),
            'height' => $childMeasurements->getHeight(),
            'weight' => $childMeasurements->getWeight(),
        ];


        $filesystem->dumpFile($path, Yaml::dump($encoded));


//        Commit files!
//        $repo = new GitRepository('.');
//        $repo->addFile($path);
//        $repo->commit('Create or update measurements for ' . $childFileId);

        // @todo: Add also photo.
    }
}