<?php

namespace App\Common;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Notes;


class Database
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getNotes()
    {

        $notes = $this->entityManager
                         ->getRepository(Notes::class)
                         ->findAll();

        return $notes;
    }

}