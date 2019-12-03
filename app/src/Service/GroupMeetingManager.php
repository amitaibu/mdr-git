<?php


namespace App\Service;


class GroupMeetingManager implements GroupMeetingManagerInterface
{

    public function index()
    {

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