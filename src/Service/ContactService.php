<?php

namespace App\Service;

use App\Entity\Classmate;
use App\Entity\ClassmateYear;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\Form;

class ContactService
{

    private $em;
    private $mailer;
    private $logger;

    public function __construct(EntityManagerInterface $em, \Swift_Mailer $mailer, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /**
     * @param Form $contact_form
     * @return bool
     */
    public function saveContact(Form $contact_form)
    {
        try{
            $contact_params = [];
            /** @var Form $classmate */
            $classmate = $contact_form->get("classmate");
            if($classmate->getNormData() !== null){
                /** @var Classmate $classmate */
                $contact_params["classmate"] = $classmate->getId();
            }
            // Get the entity for the most recent reunion
            /** @var ClassmateYear $classmate_year */
            $classmate_year = $this->em->getRepository("App\Entity\ClassmateYear")->findOneBy(["reunion_year" => getenv("reunion_year")]);

            if($classmate_year !== null){

                $this->saveContactEntity($classmate, $contact_params, $classmate_year, $contact_form);

                $this->sendContactEmail($classmate, $contact_form);

                return true;
            }else{
                $this->logger->error("Unable to determine what year it is");
                return false;
            }
        }catch(\Exception $ex){
            $this->logger->error($ex->getMessage());
            $this->logger->debug($ex->getTraceAsString());
            return false;
        }
    }

    private function sendContactEmail(?Form $classmate, Form $contact_form)
    {
        $email_message = "A new contact form submission has been made on the site " . getenv("SITE_NAME") . PHP_EOL . PHP_EOL;
        $email_message .= "Classmate: " . ($classmate->getNormData() ? $classmate->__toString() : "not provided" . PHP_EOL);
        $email_message .= "Email: " . ($contact_form->get("email")->getData() ? $contact_form->get("email")->getData() : "not provided") . PHP_EOL;
        $email_message .= "Current Name: " . ($contact_form->get("current_name")->getData() ? $contact_form->get("current_name")->getData() : "not provided") . PHP_EOL;
        $email_message .= "Significant Other: " . ($contact_form->get("significant_other")->getData() ? $contact_form->get("significant_other")->getData() : "not provided") . PHP_EOL;
        $email_message .= "Address: " . ($contact_form->get("address_1")->getData() ? $contact_form->get("address_1")->getData() : "not provided") . PHP_EOL;
        $email_message .= "Suite/Apt: " . ($contact_form->get("address_2")->getData() ? $contact_form->get("address_2")->getData() : "not provided") . PHP_EOL;
        $email_message .= "City: " . ($contact_form->get("city")->getData() ? $contact_form->get("city")->getData() : "not provided") . PHP_EOL;
        $email_message .= "State: " . ($contact_form->get("state")->getData() ? $contact_form->get("state")->getData() : "not provided") . PHP_EOL;
        $email_message .= "Zip: " . ($contact_form->get("zip")->getData() ? $contact_form->get("zip")->getData() : "not provided") . PHP_EOL;
        $email_message .= "Information: " . ($contact_form->get("info_string")->getData() ? PHP_EOL . $contact_form->get("info_string")->getData() : "not provided");

        $message = (new \Swift_Message("Contact Form Submission From The " . getenv("short_name") . " Site"))
            ->setFrom(getenv("from_addr"))
            ->setTo(getenv("recipient_addr"))
            ->setBody(
                $email_message,
                "text/plain"
            );

        $this->mailer->send($message);
    }
    private function saveContactEntity(?Form $classmate, array $contact_params, ClassmateYear $classmate_year, Form $contact_form)
    {
        $contact_params["classmate_year"] = $classmate_year->getId();

        $contact = $this->em->getRepository("App\Entity\Contact")->findOneBy($contact_params);
        if($contact === null || $contact->getClassmate() === null){
            $contact = new Contact();
        }
        if($classmate->getNormData() !== null) {
            /** @var Classmate $classmate */
            $contact->setClassmate($classmate);
        }
        $contact->setClassmateYear($classmate_year);
        $contact->setAddress1($contact_form->get("address_1")->getData());
        $contact->setAddress2($contact_form->get("address_2")->getData());
        $contact->setCity($contact_form->get("city")->getData());
        $contact->setState($contact_form->get("state")->getData());
        $contact->setZip($contact_form->get("zip")->getData());
        $contact->setPhone($contact_form->get("phone")->getData());
        $contact->setInfoString($contact_form->get("info_string")->getData());
        $contact->setEmail($contact_form->get("email")->getData());
        $contact->setCurrentName($contact_form->get("current_name")->getData());
        $contact->setSignificantOther($contact_form->get("significant_other")->getData());
        $this->em->persist($contact);
        $this->em->flush();

    }
}