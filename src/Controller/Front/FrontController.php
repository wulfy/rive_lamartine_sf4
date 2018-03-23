<?php

namespace App\Controller\Front;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Notes;
use App\Common\Database;


class FrontController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function displayHomepage(Database $database)
    {
        $notes = $database->getNotes();

    	return $this->render('front/index.html.twig',array(
			'notes' => $notes,
		));
    }

}