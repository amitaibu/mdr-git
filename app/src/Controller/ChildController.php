<?php

namespace App\Controller;

use App\Entity\ChildMeasurements;
use App\Form\Type\ChildMeasurementsType;
use App\Service\ChildManagerInterface;
use App\Service\ChildMeasurementsManagerInterface;
use App\Service\GroupMeetingManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChildController extends AbstractController
{
    /**
     * @Route("/group-meetings/{groupMeetingFileId}/child/{fileId}", name="child")
     */
    public function showChildInGroupMeetingContext(
      Request $request,
      string $groupMeetingFileId,
      string $fileId,
      GroupMeetingManagerInterface $groupMeetingManager,
      ChildManagerInterface $childManager,
      ChildMeasurementsManagerInterface $childMeasurementsManager
    )
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
        /** @var ChildMeasurements $childMeasurements */
        $childMeasurements = null;
        foreach ($measurements as $index => $measurement) {
            if ($measurement->getGroupMeeting() == $groupMeeting->getFileId()) {
                $childMeasurements = $measurement;
                break;
            }
        }

        $hasExistingMeasurements = false;
        if (!$childMeasurements) {
            // New measurements
            $childMeasurements = new ChildMeasurements();
            $childMeasurements->setGroupMeeting($groupMeeting->getFileId());

            $now = new \DateTime();
            $fileId = $now->format('Y-m-d-H:i');
            $childMeasurements->setFileId($fileId);
        }
        else {
            // Existing measurements.
            $fileId = $childMeasurements->getFileId();
            $hasExistingMeasurements = true;
        }


        $form = $this->createForm(ChildMeasurementsType::class, $childMeasurements);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $childMeasurementsNewData = $form->getData();

            // @todo: Validate.

            $childMeasurementsManager->create($child->getFileId(), $fileId, $childMeasurementsNewData);

            // Reload page.
            return $this->redirect($request->getUri());
        }




        return $this->render('child/show.html.twig', [
          'child' => $child,
          'group_meeting' => $groupMeeting,
          'has_existing_measurements' => $hasExistingMeasurements,
          'form' => $form->createView(),
        ]);
    }
}
