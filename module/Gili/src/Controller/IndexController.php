<?php

declare(strict_types=1);

namespace Gili\Controller;

use Gili\Entity\Meetup;
use Gili\Repository\MeetupRepository;
use Gili\Form\MeetupForm;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class IndexController extends AbstractActionController
{
    /**
     * @var MeetupRepository
     */
    private $meetupRepository;

    /**
     * @var MeetupForm
     */
    private $meetupForm;

    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'meetups' => $this->meetupRepository->findBy([], ['title' => 'asc']),
        ]);
    }

    public function addAction()
    {
        $form = $this->meetupForm;
        $form->bind(new Meetup('', ''));
        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $meetup = $form->getData();
                $this->meetupRepository->save($meetup);
                return $this->redirect()->toRoute('meetups');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }
    public function editAction()
    {
        $form = $this->meetupForm;


        $id = $this->params()->fromRoute('params');

        $meetup = $this->meetupRepository->find($id);

        $form->bind($meetup);

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $meetup = $form->getData();
                $this->meetupRepository->save($meetup);
                return $this->redirect()->toRoute('meetups');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
            'meetup' => $meetup,
        ]);
    }
    public function deleteAction()
    {

        $id = $this->params()->fromRoute('params');

        $this->meetupRepository->delete($id);

        return $this->redirect()->toRoute('meetups');

    }
}
