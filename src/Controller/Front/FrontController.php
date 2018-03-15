<?php

namespace App\Controller\Front;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Notes;


class FrontController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function displayHomepage()
    {
        $notes = $this->getNotes();

    	return $this->render('front/index.html.twig',array(
			'notes' => $notes,
		));
    }

    protected function getNotes()
    {

        $notes = $this->getDoctrine()
                         ->getRepository(Notes::class)
                         ->findAll();

        return $notes;
    }

}