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
     * @Route("/group-meetings/{fileId}", name="group_meeting")
     */
    public function showGroupMeeting(string $fileId, GroupMeetingManagerInterface $groupMeetingManager)
    {
        $groupMeeting = $groupMeetingManager->get($fileId);

        return $this->render('group_meeting/show.html.twig', [
          'group_meeting' => $groupMeeting,
        ]);
    }
}
