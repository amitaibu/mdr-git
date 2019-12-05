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
        $mother = $motherManager->get($fileId);

        return $this->render('mother/show.html.twig', [
            'mother' => $mother,
            'group_meeting' => $groupMeeting,
        ]);
    }
}
