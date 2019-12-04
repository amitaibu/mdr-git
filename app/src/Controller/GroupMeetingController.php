<?php

namespace App\Controller;

use App\Service\GroupMeetingManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GroupMeetingController extends AbstractController
{
    /**
     * @Route("/group-meetings", name="group_meetings")
     *
     * Show list of all group meetings.
     */
    public function index(GroupMeetingManagerInterface $groupMeetingManager)
    {
        $groupMeetings = $groupMeetingManager->index();

        return $this->render('group_meeting/index.html.twig', [
            'group_meetings' => $groupMeetings,
        ]);
    }

    /**
     * @Route("/group-meetings/{fileName}", name="group_meeting")
     */
    public function showGroupMeeting(string $fileName, GroupMeetingManagerInterface $groupMeetingManager)
    {
        $groupMeeting = $groupMeetingManager->get($fileName);

        return $this->render('group_meeting/show.html.twig', [
          'group_meeting' => $groupMeeting,
        ]);
    }
}
