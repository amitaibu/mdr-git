<?php


namespace App\Service;


use App\Model\GroupMeeting;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GroupMeetingManager implements GroupMeetingManagerInterface
{

    private $serializer;
    private $kernel;

    public function __construct(SerializerInterface $serializer, KernelInterface $kernel)
    {
        $this->serializer = $serializer;
        $this->kernel = $kernel;
    }

    public function index()
    {

        return $this->getByName();
    }

    public function get($fileName): ?GroupMeeting
    {
        $groupMeetings = $this->getByName($fileName);
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
            /** @var GroupMeeting $groupMeeting */
            $groupMeeting = $this->serializer->deserialize($file->getContents(), GroupMeeting::class, 'yaml');

            // Add the file name.
            $groupMeeting->setFileId($file->getFilenameWithoutExtension());
            $groupMeetings[] = $groupMeeting;
        }


        return $groupMeetings;
    }
}