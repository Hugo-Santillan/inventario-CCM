<?php

namespace CCM\InventarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CCM\InventarioBundle\Entity\Responsable;
use CCM\InventarioBundle\Form\ResponsableType;

/**
 * Responsable controller.
 *
 */
class ResponsableController extends Controller
{

    /**
     * Lists all Responsable entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('InventarioBundle:Responsable')->findAll();

        return $this->render('InventarioBundle:Responsable:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Responsable entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Responsable();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $request->getSession()->getFlashBag()->add(
                'notice',
                'Responsable creado exitosamente!'
            );
            return $this->redirect($this->generateUrl('responsable_show', array('id' => $entity->getId())));
        }

        return $this->render('InventarioBundle:Responsable:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Responsable entity.
     *
     * @param Responsable $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Responsable $entity)
    {
        $form = $this->createForm(new ResponsableType(), $entity, array(
            'action' => $this->generateUrl('responsable_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear','attr' => array('class' => 'btn btn-success'),));


        return $form;
    }

    /**
     * Displays a form to create a new Responsable entity.
     *
     */
    public function newAction()
    {
        $entity = new Responsable();
        $form   = $this->createCreateForm($entity);

        return $this->render('InventarioBundle:Responsable:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Responsable entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventarioBundle:Responsable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Responsable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventarioBundle:Responsable:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Responsable entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventarioBundle:Responsable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Responsable entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('InventarioBundle:Responsable:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Responsable entity.
    *
    * @param Responsable $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Responsable $entity)
    {
        $form = $this->createForm(new ResponsableType(), $entity, array(
            'action' => $this->generateUrl('responsable_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Responsable entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('InventarioBundle:Responsable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Responsable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add(
                'notice',
                'Tus cambios fueron guardados!'
            );
            return $this->redirect($this->generateUrl('responsable_edit', array('id' => $id)));
        }

        return $this->render('InventarioBundle:Responsable:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Responsable entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('InventarioBundle:Responsable')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Responsable entity.');
            }

            $em->remove($entity);
            $em->flush();
            $request->getSession()->getFlashBag()->add(
                'notice',
                'Responsable eliminado exitosamente!'
            );
        }

        return $this->redirect($this->generateUrl('responsable'));
    }

    /**
     * Creates a form to delete a Responsable entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('responsable_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn btn-danger'),))
            ->getForm()
        ;
    }
}
