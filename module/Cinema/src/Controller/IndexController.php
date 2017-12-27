<?php

declare(strict_types=1);

namespace Cinema\Controller;

use Cinema\Entity\Film;
use Cinema\Repository\FilmRepository;
use Cinema\Form\FilmForm;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class IndexController extends AbstractActionController
{
    /**
     * @var FilmRepository
     */
    private $filmRepository;

    /**
     * @var FilmForm
     */
    private $filmForm;

    public function __construct(FilmRepository $filmRepository, FilmForm $filmForm)
    {
        $this->filmRepository = $filmRepository;
        $this->filmForm = $filmForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'films' => $this->filmRepository->findBy([], ['title' => 'asc']),
        ]);
    }

    public function addAction()
    {
        $form = $this->filmForm;
        $form->bind(new Film('', ''));
        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $film = $form->getData();
                $this->filmRepository->save($film);
                return $this->redirect()->toRoute('films');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }
    public function editAction()
    {
        $form = $this->filmForm;


        $id = $this->params()->fromRoute('params');

        $film = $this->filmRepository->find($id);

        $form->bind($film);

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $film = $form->getData();
                $this->filmRepository->save($film);
                return $this->redirect()->toRoute('films');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
            'film' => $film,
        ]);
    }
    public function deleteAction()
    {

        $id = $this->params()->fromRoute('params');

        $this->filmRepository->delete($id);

        return $this->redirect()->toRoute('films');

    }
}
