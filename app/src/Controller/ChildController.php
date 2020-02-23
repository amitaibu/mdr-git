<?php

namespace App\Controller;

use App\Entity\ChildMeasurements;
use App\Form\Type\ChildMeasurementsType;
use App\Service\ChildManagerInterface;
use App\Service\ChildMeasurementsManagerInterface;
use App\Service\GroupMeetingManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChildController extends AbstractController
{
    /**
     * @Route("/group-meetings/child/{groupMeetingAttendance}", name="child_in_group_meeting")
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
            $childMeasurementsFileId = $now->format('Y-m-d-H:i');
            $childMeasurements->setFileId($childMeasurementsFileId);
        }
        else {
            // Existing measurements.
            $childMeasurementsFileId = $childMeasurements->getFileId();
            $hasExistingMeasurements = true;
        }


        $form = $this->createForm(ChildMeasurementsType::class, $childMeasurements);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            /** @var ChildMeasurements $childMeasurementsNewData */
            $childMeasurementsNewData = $form->getData();

            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $photoFile */
            $photoFile = $form['photo']->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photoFile) {
                $originalFilename = pathinfo(
                  $photoFile->getClientOriginalName(),
                  PATHINFO_FILENAME
                );

                // We don't use transliterator_transliterate, since it requires
                // Php-intl, and it's not part of Termux packages.
                $safeFilename = strtolower(preg_replace('/[[:^print:]]/', '', $originalFilename));
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photoFile->move(
                      $this->getParameter('child_photos_directory'),
                      $newFilename
                    );

                    $childMeasurementsNewData->setPhoto($newFilename);

                    // Copy file to data folder.
                    // @todo: Move to service.
                    $target = '../../data/children/' . $fileId . '/measurements/' .  $childMeasurementsFileId . '/photo.' . strtolower($photoFile->getClientOriginalExtension());
                    $filesystem = new Filesystem();
                    $filesystem->copy($this->getParameter('child_photos_directory') . '/' . $newFilename, $target, true);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }


            // @todo: Validate.

            $childMeasurementsManager->create($child->getFileId(), $childMeasurementsFileId, $childMeasurementsNewData);

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
