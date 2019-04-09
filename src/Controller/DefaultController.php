<?php

namespace App\Controller;

use App\Entity\ClassmateYear;
use App\Form\ContactType;
use App\Service\ContactService;
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

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param ContactService $contact_service
     * @return Response
     */
    public function contact(Request $request, ContactService $contact_service = null)
    {
        $contact_form = $this->createForm(ContactType::class);

        $contact_form->handleRequest($request);

        if ($contact_form->isSubmitted() && $contact_form->isValid()) {
            if($contact_service->saveContact($contact_form) === true){
                $this->addFlash("success", "Thanks for updating your information!");
            }else{
                $this->addFlash("danger", "Problems happen to everyone");
            }
            return $this->redirectToRoute("contact");
        }

        return $this->render("contact.html.twig", [
            "contact_form" => $contact_form->createView(),
        ]);
    }
}
