<?php

namespace App\Controller;

use App\Domain\Marble\Competition;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/list", name="user_winner")
     */
    public function list(): Response
    {

        return $this->render('base.html.twig');
    }
}