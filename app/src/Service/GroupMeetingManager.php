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

        $finder = new Finder();
        $finder
          ->files()
          ->in($this->kernel->getProjectDir() . '/../data/group-meetings/')
          ->name('*.yaml');

        $groupMeetings = [];

        foreach ($finder as $file) {
            $groupMeetings[] = $this->serializer->deserialize($file->getContents(), GroupMeeting::class, 'yaml');
        }


        return $groupMeetings;
    }

}