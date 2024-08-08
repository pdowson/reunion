<?php

namespace App\Controller;

use App\Entity\ClassmateYear;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $parameters["controller_name"] =  'DefaultController';
        $parameters["reunions"] = $em->getRepository(ClassmateYear::class)->findBy([], ["reunion_year" => "DESC"]);
        return $this->render('index.html.twig', $parameters);
    }
}
