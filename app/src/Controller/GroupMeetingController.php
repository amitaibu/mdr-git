<?php

namespace App\Controller;

use App\Service\GroupMeetingManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GroupMeetingController extends AbstractController
{
    /**
     * @Route("/group-meeting", name="group_meeting")
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
}
