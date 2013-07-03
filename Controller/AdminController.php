<?php

/*
 * This file is part of the Blackengine package.
 *
 * (c) Alexandre Balmes <albalmes@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_index")
     * @Secure(roles="ROLE_ADMIN")
     * @Template()
     */
    public function indexAction()
    {
        $personManager      = $this->getPersonManager();
        
        $countPerson        = $personManager->countAll();

        $persons            = $personManager->getLastPersons();
        
        return array(
            'countPerson'   => $countPerson,
            'persons'       => $persons,
        );
    }

    /**
     * @Route("/search", name="admin_search_json", defaults={"_format"="json"})
     * @Secure(roles="ROLE_ADMIN")
     * @Method({"GET"})
     * @Template()
     */
    public function searchJsonAction()
    {
        $request = $this->get('request');

        if (!$request->isXmlHttpRequest()) {
            return array('response' => array(
                0 => array(
                    'label' => 'error',
                    'value' => 'Request is not valid'
                )
            ));
        }

        $documentManager = $this->getPersonManager();
        $repository = $documentManager->getRepository();

        $rawDocuments = $repository->searchUser($request->query->get('text'));

        $documents = array();

        foreach ($rawDocuments as $document) {
            $documents[$document->getId()] = array(
                'id'            => $document->getId(),
                'name'          => $document->getName(),
            );
        }

        return array(
            'response' => $documents
        );
    }

    /**
     * @Route("/sendmail", name="admin_sendmail")
     * @Secure(roles="ROLE_ADMIN")
     * @Method({"POST"})
     */
    public function sendMail()
    {
        $request    = $this->get('request');
        $parameters = $request->request->get('black_engine_contact');

        if ('POST' === $request->getMethod()) {
            $manager      = $this->getPersonManager();
            $repository   = $manager->getRepository();

            $document = $repository->findOneById($parameters['to']);

            if (!$document) {
                throw $this->createNotFoundException('Unable to find Person document.');
            }

            $form = $this->createForm($this->get('black_engine.contact.form.type'), array('id' => $parameters['to']));
            $form->bind($this->getRequest());

            if ($form->isValid()) {
                $this->get('black_engine.mailer')->sendContactMessage($document, $this->getUser(), $parameters);
                $this->get('session')->getFlashbag()->add('success', 'success.admin.admin.mail.send');
            }
        }

        return $this->redirect($this->generateUrl('admin_person_show', array('id' => $parameters['to'])));
    }

    protected function getPersonManager()
    {
        return $this->get('black_engine.manager.person');
    }
}
