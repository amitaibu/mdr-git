<?php

namespace App\Controller;

use App\Repository\GroupMeetingAttendanceListRepository;
use App\Service\GroupMeetingManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GroupMeetingController extends AbstractController
{
    /**
     * @Route("/", name="group_meetings")
     *
     * Show list of all group meetings.
     */
    public function index(GroupMeetingAttendanceListRepository $groupMeetingAttendanceListRepository)
    {
        $groupMeetingsAttendanceList = $groupMeetingAttendanceListRepository->findAll();

        return $this->render('group_meeting/index.html.twig', [
            'group_meeting_attendance_list' => $groupMeetingsAttendanceList,
        ]);
    }

    /**
     * @Route("/group-meetings/{id}", name="group_meeting")
     */
    public function show(string $id, GroupMeetingAttendanceListRepository $groupMeetingAttendanceListRepository)
    {
        $groupMeeting = $groupMeetingAttendanceListRepository->find($id);

        if (!$groupMeeting) {
            throw $this->createNotFoundException('Group meeting not found.');
        }

        return $this->render('group_meeting/show.html.twig', [
          'group_meeting' => $groupMeeting,
        ]);
    }
}
