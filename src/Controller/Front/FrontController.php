<?php

namespace App\Controller\Front;

use App\Common\Database;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function displayHomepage(Database $database): Response
    {
        $notes = $database->getNotes();

        return $this->render('front/index.html.twig', [
            'notes' => $notes,
        ]);
    }
}
