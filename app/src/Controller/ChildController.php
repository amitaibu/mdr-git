<?php

namespace App\Controller;

use App\Service\ChildManagerInterface;
use App\Service\GroupMeetingManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChildController extends AbstractController
{
    /**
     * @Route("/group-meetings/{groupMeetingFileId}/child/{fileId}", name="child")
     */
    public function showChildInGroupMeetingContext(string $groupMeetingFileId, string $fileId, ChildManagerInterface $childManager, GroupMeetingManagerInterface $groupMeetingManager)
    {

        $groupMeeting = $groupMeetingManager->get($groupMeetingFileId);
        if (!$groupMeeting) {
            throw $this->createNotFoundException('Group meeting not found.');
        }

        $child = $childManager->get($fileId);
        if (!$child) {
            throw $this->createNotFoundException('Child not found.');
        }

        // Check if Child already has measurements for the selected group
        // meeting.
        $measurementsFromGroupMeetingIndex = null;
        $measurements = $child->getMeasurements() ?: [];
        foreach ($measurements as $index => $measurement) {
            if ($measurement->getGroupMeeting() == $groupMeeting->getFileId()) {
                $measurementsFromGroupMeetingIndex = $index;
                break;
            }
        }


        return $this->render('child/show.html.twig', [
          'child' => $child,
          'group_meeting' => $groupMeeting,
          'measurements_from_group_meeting_index' => $measurementsFromGroupMeetingIndex,
        ]);
    }
}
