<?php


namespace App\Service;


use App\Entity\GroupMeeting;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Yaml\Yaml;

class GroupMeetingManager implements GroupMeetingManagerInterface
{

    private $denormalizer;
    private $kernel;
    private $motherManager;

    public function __construct(DenormalizerInterface $denormalizer, KernelInterface $kernel, MotherManagerInterface $motherManager)
    {
        $this->denormalizer = $denormalizer;
        $this->kernel = $kernel;
        $this->motherManager = $motherManager;
    }

    public function index()
    {

        return $this->getByName();
    }

    public function get($fileId): ?GroupMeeting
    {
        $groupMeetings = $this->getByName($fileId);
        return $groupMeetings ? reset($groupMeetings) : null;
    }

    protected function getByName(string $name = '*')
    {
        $finder = new Finder();
        $finder
          ->files()
          ->in($this->kernel->getProjectDir() . '/../data/group-meetings/')
          ->name($name . '.yaml');

        $groupMeetings = [];

        foreach ($finder as $file) {
            $data = Yaml::parse($file->getContents());

            /** @var GroupMeeting $groupMeeting */
            $groupMeeting = $this->denormalizer->denormalize($data, GroupMeeting::class);

            // Add the file name.
            $groupMeeting->setFileId($file->getFilenameWithoutExtension());

            // Add Mother identifiers.
            $this->addMotherIdentifiers($groupMeeting, $data);

            $groupMeetings[] = $groupMeeting;
        }


        return $groupMeetings;
    }

    private function addMotherIdentifiers(GroupMeeting $groupMeeting, array $data) {
        $motherIdentifiers = [];
        foreach ($data['mothers'] as $fileId) {
            $motherIdentifiers[] = $this->motherManager->getIdentifier($fileId);
        }

        $groupMeeting->setMotherIdentifiers($motherIdentifiers);
    }
}