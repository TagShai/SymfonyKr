<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use AppBundle\Entity\Work;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
class WorkController extends Controller
{
    /**
     * @Route("/works",name="work_list")
     */
    public function listAction()
    {
        $works=$this->getDoctrine()
            ->getRepository("AppBundle:Work")
            ->findAll();

        $customers=$this->getDoctrine()
            ->getRepository("AppBundle:Customer")
            ->findAll();

        $workers=$this->getDoctrine()
            ->getRepository("AppBundle:Worker")
            ->findAll();


        return $this->render('AppBundle:Work:index.html.twig',array(
            'works' => $works,
            'customers' => $customers,
            'workers' => $workers,

        ));
    }

    /**
     * @Route("/works/create",name="work_create")
     */
    public function createAction(Request $request)
    {
        $work=new Work;
        $customer=new Customer;
        $form=$this->createFormBuilder($work)
            ->add('theme', TextType::class,array("label"=> "Theme:",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('notes',TextareaType::class,array("label"=> "Notes to work",'attr'=>array(
                'class' => "form-control"
            )))
            ->add('worker', EntityType::class, array(
                'class' => 'AppBundle:Worker',
                'choice_label' => 'name',
                'placeholder' => 'Choose worker',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:WorkCategory',
                'choice_label' => 'name',
                'placeholder' => 'Choose category',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('customer', EntityType::class, array(
                'class' => 'AppBundle:Customer',
                'choice_label' => 'name',
                'required'=>false,
                'placeholder' => 'Choose customer',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('isDone',CheckboxType::class,array(
                'label'=> 'isDone?',
                'required' => false,
                'attr' => array(
                    "class" => "checkbox"
                )
            ))

            ->add('submit', SubmitType::class,array('label'=> 'Create work','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $theme=$form['theme']->getData();
            $notes=$form['notes']->getData();
            $worker=$form['worker']->getData();
            $category=$form['category']->getData();
            $customer=$form['customer']->getData();
            $done=$form['isDone']->getData();

            $work->setTheme($theme);
            $work->setNotes($notes);
            $work->setWorker($worker);
            $work->setCategory($category);
            $work->setCustomer($customer);
            $work->setIsDone($done);


            $em=$this->getDoctrine()->getManager();
            $em->persist($work);
            $em->flush();
            if($customer!=null) {
                $customer->setWork($work);


            $em=$this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
            }
            $this->addFlash(
                'notice',
                'Work added'
            );
            return $this->redirectToRoute("work_list");

        }
        return $this->render("AppBundle:Work:create.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/works/edit/{id}",name="work_edit")
     */
    public function editAction($id,Request $request)
    {
        $work=$this->getDoctrine()
            ->getRepository("AppBundle:Work")->find($id);
        $worker=$work->getWorker();
        $customers=$this->getDoctrine()
            ->getRepository("AppBundle:Customer")->find($work->getId());
        $form=$this->createFormBuilder($work)
/*            ->add('theme', TextType::class,array("label"=> "Theme:",'attr' => array(
                'class' =>"form-control"
            )))
            ->add('notes',TextareaType::class,array("label"=> "Notes to work",'attr'=>array(
                'class' => "form-control"
            )))*/
            ->add('worker', EntityType::class, array(
                'class' => 'AppBundle:Worker',
                'choice_label' => 'name',
                'placeholder' => 'Choose worker',
                'attr'=>array(
                    "class" => "form-control",
                )))
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:WorkCategory',
                'choice_label' => 'name',
                'placeholder' => 'Choose category',
                'attr'=>array(
                    "class" => "form-control",
                )))
/*            ->add('customer', EntityType::class, array(
                'class' => 'AppBundle:Customer',
                'choice_label' => 'name',
                'required'=>false,
                'placeholder' => 'Choose customer',
                'attr'=>array(
                    "class" => "form-control",
                )))*/
            ->add('isDone',CheckboxType::class,array(
                'label'=> 'isDone?',
                'required' => false,
                'attr' => array(
                    "class" => "checkbox"
                )
            ))

            ->add('submit', SubmitType::class,array('label'=> 'Edit work','attr' => array(
                'class' => 'btn btn-primary',
                'style' => 'margin-bottom: 15px; margin-top: 30px')))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
/*            $theme=$form['theme']->getData();
            $notes=$form['notes']->getData();*/
            $worker=$form['worker']->getData();
            $category=$form['category']->getData();
            //$customer=$form['customer']->getData();
            $done=$form['isDone']->getData();

            $em=$this->getDoctrine()->getManager();
            $work=$em->getRepository("AppBundle:Work")->find($id);


/*            $work->setTheme($theme);
            $work->setNotes($notes);*/
            $work->setWorker($worker);
            $work->setCategory($category);
            //$work->setCustomer($customer);
            $work->setIsDone($done);
/*            if($worker!=null){
            $workers=$em->getRepository("AppBundle:Worker")->find($worker);
                if($workers!=null) {
                    if($current_student!=null){
                    $current=$em->getRepository("AppBundle:Student")->find($current_student->getId());
                    $current->setWork(null);
                    }

                    $studentq->setWork($work);
                }
            }

            else {
                if ($current_student != $student){
                    $studentq = $em->getRepository("AppBundle:Student")->find($current_student->getId());
                $studentq->setWork(null);
            }
            }*/



            $em->flush();
            $this->addFlash(
                'notice',
                'Work edited'
            );
            return $this->redirectToRoute("work_list");
        }
        return $this->render("AppBundle:Work:edit.html.twig",array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/works/delete/{id}",name="work_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $work = $em->getRepository('AppBundle:Work')->find($id);
        $em->remove($work);
        $em->flush();

        $this->addFlash(
            'notice',
            'Work deleted'
        );
        return $this->redirectToRoute("work_list");
    }

    /*
     * @Route("/works/category/{id}",name="work_category_list")
     */
/*    public function categoryWorksAction($id,Request $request){
        $works=$this->getDoctrine()
            ->getRepository("AppBundle:Work")
            ->findByCategory($id);
        return $this->render('AppBundle:Work:index.html.twig',array(
            'works' => $works,

        ));
    }*/

    /*
     * @Route("/courseworks",name="work_courseworks")
     */
/*    public function courseworksAction(){
        $works=$this->getDoctrine()
            ->getRepository("AppBundle:Work")
            ->findBy(
                array(
                    "isDiploma" => "0"
                )
            );
        return $this->render('AppBundle:Work:index.html.twig',array(
            'works' => $works,

        ));
    }*/

    /*
     * @Route("/diplomaworks",name="work_diplomaworks")
     */
/*    public function diplomaAction(){
        $works=$this->getDoctrine()
            ->getRepository("AppBundle:Work")
            ->findBy(
                array(
                    "isDiploma" => "1"
                )
            );
        return $this->render('AppBundle:Work:index.html.twig',array(
            'works' => $works,

        ));
    }*/

}
