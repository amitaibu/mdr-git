<?php

namespace App\Controller;

use App\Entity\Child;
use App\Entity\GroupMeeting;
use App\Entity\GroupMeetingAttendance;
use App\Entity\Mother;
use App\Entity\Person;
use App\Repository\GroupMeetingAttendanceRepository;
use App\Repository\GroupMeetingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GroupMeetingController extends AbstractController
{
    /**
     * @Route("/", name="group_meetings")
     *
     * Show list of all group meetings.
     */
    public function index(GroupMeetingRepository $groupMeetingRepository)
    {
        $groupMeetings = $groupMeetingRepository->findAll();

        return $this->render('group_meeting/index.html.twig', [
            'group_meetings' => $groupMeetings,
        ]);
    }

    /**
     * @Route("/group-meetings/{id}", name="group_meeting")
     */
    public function show(GroupMeeting $groupMeeting)
    {

        $groupMeetingAttendances = $groupMeeting
          ->getGroupMeetingAttendances()
          ->toArray();

        // For now keep only children.
        $childrenGroupMeetingAttendances = array_filter($groupMeetingAttendances, function(GroupMeetingAttendance $groupMeetingAttendance) {
            return $groupMeetingAttendance->getPerson() instanceof Child;
        });

        // Sort attendance by the person's first name.
        usort($childrenGroupMeetingAttendances, function($a, $b) {
            return strcmp($a->getPerson()->getFirstName(), $b->getPerson()->getFirstName());
        });


        return $this->render('group_meeting/show.html.twig', [
          'group_meeting' => $groupMeeting,
          'children_group_meeting_attendances' => $childrenGroupMeetingAttendances,
        ]);
    }
}
