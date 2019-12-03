<?php


namespace App\Service;


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
          ->name('invitee.yaml');



        foreach ($finder as $file) {
            $absoluteFilePath = $file->getRealPath();
            $fileNameWithExtension = $file->getRelativePathname();

            // ...
            dump($absoluteFilePath);
        }




        return [
          '2020-01-30-morning' => [
            'name' => 'foo',
            'mothers' => [
                'ann-foo-789456' => ['first_name' => 'Ann', 'last_name' => 'Foo'],
            ],
            'children' => [],
          ],
        ];

    }

}