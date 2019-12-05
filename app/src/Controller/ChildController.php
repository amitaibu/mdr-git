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

        return $this->render('child/show.html.twig', [
          'child' => $child,
          'group_meeting' => $groupMeeting,
        ]);
    }
}
