<?php declare(strict_types = 1);

namespace App\Service;


use App\Model\GroupMeeting;

interface GroupMeetingManagerInterface
{

    /**
     *  Return a list of Group meetings.
     */
    public function index();

    public function get($fileId) : ?GroupMeeting;

}