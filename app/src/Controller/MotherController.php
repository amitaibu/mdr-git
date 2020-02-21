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
     * @Route("/group-meetings/{groupMeetingAttendanceList}/mother/{mother}", name="mother")
     */
    public function showMotherInGroupMeetingContext(GroupMeetingAttendance $groupMeetingAttendance, Mother $mother)
    {

        return $this->render('mother/show.html.twig', [
            'group_meeting_attendance' => $groupMeetingAttendance,
        ]);
    }
}
