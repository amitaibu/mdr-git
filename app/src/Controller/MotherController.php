<?php

namespace App\Controller;

use App\Entity\GroupMeetingAttendance;
use App\Entity\Mother;
use App\Service\GroupMeetingManagerInterface;
use App\Service\MotherManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MotherController extends AbstractController
{
    /**
     * @Route("/group-meetings/mother/{groupMeetingAttendance}", name="mother")
     */
    public function showMotherInGroupMeetingContext(GroupMeetingAttendance $groupMeetingAttendance)
    {

        return $this->render('mother/show.html.twig', [
            'group_meeting_attendance' => $groupMeetingAttendance,
        ]);
    }
}
