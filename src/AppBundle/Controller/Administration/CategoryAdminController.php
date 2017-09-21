<?php


namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Category;
use AppBundle\Form\Type\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryAdminController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AppBundle:Category')->findAll();
        return $this->render(':Admin/Category:index.html.twig', ['categories' => $categories ]);
    }

    public function createAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash('info', 'La catégorie a bien été enregistré !');
            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render(':Admin/Category:create.html.twig', ['form' => $form->createView()]);
    }

    public function deleteAction(Request $request)
    {
        $id = htmlspecialchars($request->request->get('id'));
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Category')->findOneBy(['id' => $id]);
        if($category !== null) {
            $em->remove($category);
            $em->flush();
            $this->addFlash('success', 'La catégorie a bien été supprimé');  
        } else {
            $this->addFlash('danger', 'Vous essayer de supprimer une categorie inexistante');
        }

        return $this->redirectToRoute('admin_category_index');
        
    }

    public function editAction(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash('info', 'La catégorie a bien été modifié');

            return $this->redirectToRoute("admin_category_index");
        }
        return $this->render(':Admin/Category:edit.html.twig', ['form' => $form->createView()]);
    }
}