<?php


namespace AppBundle\Controller\Administration;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EntityAdminController extends Controller
{

    public function indexAction($entityName)
    {
        $em = $this->getDoctrine()->getManager();

        $objects = $em->getRepository('AppBundle:'. ucfirst($entityName))->findAll();
        return $this->render(':Admin/' . ucfirst($entityName) . ':index.html.twig', ['objects' => $objects ]);
    }
    /**
     * fonction generique de l'admin permettant de créer une entité
     * @param $entityName
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @internal param $entity
     */
    public function createAction($entityName, Request $request)
    {
        // On va commencer par passer l'entityName en majuscule.
        $entityName = ucfirst($entityName);

        // On crée ensuite le nom de l'entity et du form correspondant  avec le namespace
        // Pour créer dynamiquement une instance de l'entity et du form
        $className = 'AppBundle\Entity\\' . $entityName;
        $object = new $className();

        $formName = "AppBundle\Form\Type\\" . $entityName . 'Type';

        $form = $this->createForm( $formName , $object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            // Enregistrement de l'objet en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();

            $this->addFlash('info', 'La demande a bien été enregistré !');
            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render(':Admin/'. $entityName . ':create.html.twig', ['form' => $form->createView()]);
    }


    /**
     * Fonction générique pour la modification d'entité
     * @param $entityName
     * @param $slug
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction($entityName, $slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $object = $em->getRepository('AppBundle:'. ucfirst($entityName))->findOneBy(['slug' =>$slug]);

        $formName = 'AppBundle\Form\Type\Edit' . ucfirst($entityName) . 'Type';
        $form = $this->createForm($formName, $object);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();

            $this->addFlash('info', 'La demande a bien été modifié');

            return $this->redirectToRoute("admin_category_index");
        }
        return $this->render(':Admin/' . ucfirst($entityName) . ':edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Fonction générique pour la suppression d'entité
     * @param $entityName
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($entityName, Request $request)
    {
        $id = htmlspecialchars($request->request->get('id'));
        $em = $this->getDoctrine()->getManager();
        $object = $em->getRepository('AppBundle:' . ucfirst($entityName))->findOneBy(['id' => $id]);
        if($object !== null) {
            $em->remove($object);
            $em->flush();
            $this->addFlash('success', 'La catégorie a bien été supprimé');
        } else {
            $this->addFlash('danger', 'Vous essayer de supprimer une categorie inexistante');
        }

        return $this->redirectToRoute('admin_entity_index', ['entityName' => $entityName]);

    }
}