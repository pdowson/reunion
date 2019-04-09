<?php

namespace App\Controller;

use App\Entity\Classmate;
use App\Form\ContactType;
use App\Service\ContactService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClassmateController
 * @package App\Controller
 */
class ClassmateController extends AbstractController
{
    /**
     * @Route("/classmate", name="classmate_home", options={"expose"=true})
     */
    public function classmateHome()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $parameters["classmates"] = $em->getRepository(Classmate::class)->findBy(
            [
                "is_missing" => "not_missing"
            ],
            [
                "last_name" => "ASC",
                "first_name" => "ASC"
            ]
        );
        return $this->render('classmates.html.twig', $parameters);
    }

    /**
     * @Route("/classmate/{id<\d+>?1}", name="classmate_detail", options={"expose"=true})
     * @param $request Request)
     * @param $id integer
     * @param $contact_service ContactService
     * @return Response
     */
    public function classmateDetail(Request $request, $id, ContactService $contact_service = null)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $parameters["classmate"] = $em->getRepository(Classmate::class)->findOneBy(
            [
                "id" => $id,
                "is_missing" => "not_missing"
            ],
            [
                "last_name" => "ASC",
                "first_name" => "ASC"
            ]
        );

        $contact_form = $this->createForm(ContactType::class);
        $contact_form->handleRequest($request);

        if ($contact_form->isSubmitted() && $contact_form->isValid()) {
            if($contact_service->saveContact($contact_form) === true){
                $this->addFlash("success", "Thanks for updating your information!");
            }else{
                $this->addFlash("danger", "Problems happen to everyone");
            }
            return $this->redirectToRoute("classmate_detail", ["id" => $id]);
        }

        $parameters["contact_form"] = $contact_form->createView();

        return $this->render('detail.html.twig', $parameters);
    }

    /**
     * @Route("/missing", name="classmate_missing", options={"expose"=true})
     */
    public function classmateMissing()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $parameters["classmates_missing"] = $em->getRepository(Classmate::class)->findBy(
            [
                "is_missing" => "missing"
            ],
            [
                "is_missing" => "ASC",
                "last_name" => "ASC",
                "first_name" => "ASC"
            ]
        );
        $parameters["classmates_missing_after_91"] = $em->getRepository(Classmate::class)->findBy(
            [
                "is_missing" => "missing_after_91"
            ],
            [
                "is_missing" => "ASC",
                "last_name" => "ASC",
                "first_name" => "ASC"
            ]
        );
        $parameters["classmates_missing_after_92"] = $em->getRepository(Classmate::class)->findBy(
            [
                "is_missing" => "missing_after_92"
            ],
            [
                "is_missing" => "ASC",
                "last_name" => "ASC",
                "first_name" => "ASC"
            ]
        );
        $parameters["classmates_missing_after_93"] = $em->getRepository(Classmate::class)->findBy(
            [
                "is_missing" => "missing_after_93"
            ],
            [
                "is_missing" => "ASC",
                "last_name" => "ASC",
                "first_name" => "ASC"
            ]
        );
        return $this->render('missing.html.twig', $parameters);
    }
}