<?php

namespace App\Controller;

use App\Service\MotherManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MotherController extends AbstractController
{
    /**
     * @Route("/mother/{fileName}", name="mother")
     */
    public function showMother(string $fileName, MotherManagerInterface $motherManager)
    {

        $motherFull = $motherManager->getFull($fileName);

        return $this->render('mother/show.html.twig', [
            'mother' => $motherFull,
        ]);
    }
}
