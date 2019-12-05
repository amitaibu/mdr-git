<?php

namespace App\Controller;

use App\Service\GroupMeetingManagerInterface;
use App\Service\MotherManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MotherController extends AbstractController
{
    /**
     * @Route("/group-meetings/{groupMeetingFileId}/mother/{fileId}", name="mother")
     */
    public function showMotherInGroupMeetingContext(string $groupMeetingFileId, string $fileId, MotherManagerInterface $motherManager, GroupMeetingManagerInterface $groupMeetingManager)
    {

        $groupMeeting = $groupMeetingManager->get($groupMeetingFileId);
        if (!$groupMeeting) {
            throw $this->createNotFoundException('Group meeting not found.');
        }

        $mother = $motherManager->get($fileId);
        if (!$mother) {
            throw $this->createNotFoundException('Mother not found.');
        }

        return $this->render('mother/show.html.twig', [
            'mother' => $mother,
            'group_meeting' => $groupMeeting,
        ]);
    }
}
