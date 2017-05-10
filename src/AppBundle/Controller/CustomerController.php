<?php

namespace AppBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Customer;
use AppBundle\Entity\Work;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CustomerController extends Controller
{
    /**
     * @Route("/customers",name="customer_list")
     */
    public function listAction()
    {
        $customers=$this->getDoctrine()
            ->getRepository("AppBundle:Customer")
            ->findAll();
        return $this->render('AppBundle:Customer:index.html.twig',array(
            'customers' => $customers,

        ));
    }

    /**
     * @Route("/customers/create",name="student_create")
     */
    public function createAction(Request $request)
    {
        $customer=new Customer;
        $form=$this->createFormBuilder($customer)
            ->add('lname', TextType::class,array("label"=> "Last name",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('fname', TextType::class,array("label"=> "First name",'attr' => array(
                'class' =>"form-control"
            )))

            ->add('mname', TextType::class,array("label"=> "Middle name",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('email', EmailType::class,array('attr' => array(
                'class' =>"form-control"
            )))
            ->add('address', TextType::class,array('attr' => array(
                'class' =>"form-control"
            )))
            ->add('submit', SubmitType::class,array('label'=> 'Create student','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))

            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $fname=$form['fname']->getData();
            $lname=$form['lname']->getData();
            $mname=$form['mname']->getData();
            $email=$form['email']->getData();
            $address=$form['address']->getData();

            $customer->setFname($fname);
            $customer->setLname($lname);
            $customer->setMname($mname);
            $customer->setEmail($email);
            $customer->setAddress($address);


            $em=$this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            $this->addFlash(
                'notice',
                'Customer added'
            );
            return $this->redirectToRoute("customer_list");

        }
        return $this->render("AppBundle:Customer:create.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/customers/edit/{id}",name="customer_edit")
     */
    public function editAction($id,Request $request)
    {
        $customer=$this->getDoctrine()
            ->getRepository("AppBundle:Customer")->find($id);


        $form=$this->createFormBuilder($customer)
            ->add('lname', TextType::class,array("label"=> "Last name",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('fname', TextType::class,array("label"=> "First name",'attr' => array(
                'class' =>"form-control"
            )))

            ->add('mname', TextType::class,array("label"=> "Middle name",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('email', EmailType::class,array('attr' => array(
                'class' =>"form-control"
            )))
            ->add('address', TextType::class,array('attr' => array(
                'class' =>"form-control"
            )))
            ->add('submit', SubmitType::class,array('label'=> 'Edit student','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $fname=$form['fname']->getData();
            $lname=$form['lname']->getData();
            $mname=$form['mname']->getData();
            $email=$form['email']->getData();
            $address=$form['address']->getData();

            $em=$this->getDoctrine()->getManager();
            $customer=$em->getRepository("AppBundle:Customer")->find($id);

            $customer->setFname($fname);
            $customer->setLname($lname);
            $customer->setMname($mname);
            $customer->setEmail($email);
            $customer->setAddress($address);


            $em->flush();

            $this->addFlash(
                'notice',
                'Customer edited'
            );
            return $this->redirectToRoute("customer_list");
        }
        return $this->render("AppBundle:Customer:edit.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/customers/delete/{id}",name="student_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('AppBundle:Customer')->find($id);
        $em->remove($student);
        $em->flush();

        $this->addFlash(
            'notice',
            'Customer deleted'
        );
        return $this->redirectToRoute("customer_list");
    }


}
