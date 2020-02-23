<?php

namespace App\Controller;

use App\Entity\ChildMeasurements;
use App\Entity\GroupMeetingAttendance;
use App\Form\Type\ChildMeasurementsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChildController extends AbstractController
{
    /**
     * @Route("/group-meetings/child/{groupMeetingAttendance}", name="child_in_group_meeting")
     */
    public function showChildInGroupMeeting(
      GroupMeetingAttendance $groupMeetingAttendance,
      Request $request,
      EntityManagerInterface $entityManager
    )
    {

        $groupMeeting = $groupMeetingAttendance->getGroupMeeting();
        $child = $groupMeetingAttendance->getPerson();

        // Check if Child already has measurements for the selected group
        // meeting.
        $measurements = $groupMeetingAttendance->getMeasurements() ?: [];
        $hasExistingMeasurements = true;

        if (empty($measurements)) {
            // New measurements
            $measurements = new ChildMeasurements();
            $measurements->setGroupMeetingAttendance($groupMeetingAttendance);
            $hasExistingMeasurements = false;
        }

        $form = $this->createForm(ChildMeasurementsType::class, $measurements);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

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

                    $measurements->setPhoto($newFilename);
                    dump($newFilename);

                    // Copy file to data folder.
                    // @todo: Move to service.
                    $fileId = $groupMeetingAttendance->getPerson()->getId();
                    $measurementsFileId = $groupMeetingAttendance->getGroupMeeting()->getId();

                    $target = '../../data/children/' . $fileId . '/measurements/' .  $measurementsFileId . '/photo.' . strtolower($photoFile->getClientOriginalExtension());
                    $filesystem = new Filesystem();
                    $filesystem->copy($this->getParameter('child_photos_directory') . '/' . $newFilename, $target, true);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }


            // @todo: Validate.

            // $measurementsManager->create($child->getFileId(), $measurementsFileId, $measurementsNewData);

            $entityManager->persist($measurements);
            $entityManager->flush();

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
