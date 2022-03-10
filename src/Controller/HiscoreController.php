<?php

namespace App\Controller;

use App\Entity\Hiscore;
use App\Repository\HiscoreRepository;
use App\Repository\UserRepository;
use App\Form\HiscoreFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HiscoreController extends AbstractController
{
    private $em;
    private $hiscoreRepository;
    public function __construct(EntityManagerInterface $em, HiscoreRepository $hiscoreRepository, UserRepository $userRepository) 
    {
        $this->em = $em;
        $this->hiscoreRepository = $hiscoreRepository;
        $this->userRepository = $userRepository;
    }

    #[Route('/hiscore', methods: ['GET'], name: 'app_hiscore')]
    public function index(Request $request): Response
    {
        $hiscores = array();
        $showPosition = true;

        $sortFilter = $request->query->get('sort');
        if($sortFilter)
        {
            $showPosition = false;
            if($sortFilter == 'name')
            {
                $hiscores = $this->hiscoreRepository->findAllOrderByUserEmail();
            }
            elseif($sortFilter == 'difficulty')
            {
                $hiscores = $this->hiscoreRepository->findBy(['moderated'=>true,'deleted'=>false],array('difficulty'=>'ASC','score'=>'DESC'));
            }
            elseif($sortFilter == 'score')
            {
                $hiscores = $this->hiscoreRepository->findBy(['moderated'=>true,'deleted'=>false],array('score'=>'DESC'));
            }
        }
        else
        {
            $users = $this->userRepository->findAll();
            foreach($users as $user)
            {
                $highestScore = $this->hiscoreRepository->findUsersHighestLegitScore($user);
                if($highestScore)
                    $hiscores[] = $highestScore;

                usort($hiscores,function($first,$second){
                    return $first->getScore() < $second->getScore();
                });
            }
        }
        
        return $this->render('hiscore/index.html.twig', [
            'hiscores' => $hiscores,
            'showPosition' => $showPosition
        ]);
    }

    #[Route('/hiscore/create', methods: ['GET','POST'], name: 'app_hiscore_create')]
    public function create(Request $request, UserInterface $user): Response
    {
        $hiscore = new Hiscore();
        $hiscoreForm = $this->createForm(HiscoreFormType::class, $hiscore);

        $hiscoreForm->handleRequest($request);

        if($hiscoreForm->isSubmitted() && $hiscoreForm->isValid())
        {
            $newHiscore = $hiscoreForm->getData();
            $newHiscore->setModerated(false);
            $newHiscore->setDeleted(false);
            $newHiscore->setUser($user);
            $this->em->persist($newHiscore);
            $this->em->flush();
            return $this->redirectToRoute('app_hiscore');
        }

        return $this->render('hiscore/create.html.twig', [
            'hiscoreForm' => $hiscoreForm->createView()
        ]);
    }

    #[Route('/hiscore/delete/{id}', methods: ['GET'], name: 'app_hiscore_delete')]
    public function delete($id): Response
    {
        $hiscore = $this->hiscoreRepository->find($id);
        $hiscore->setDeleted(true);
        $this->em->persist($hiscore);
        $this->em->flush();
        return $this->redirectToRoute('app_admin');
    }

    #[Route('/hiscore/user/{id}', methods: ['GET'], name: 'app_hiscore_user')]
    public function userFilter($id): Response
    {
        $hiscores = $this->hiscoreRepository->findBy(['user'=>$id,'moderated'=>true,'deleted'=>false],['score'=>'DESC', 'difficulty'=>'DESC']);
        return $this->render('hiscore/filter.html.twig', [
            'hiscores' => $hiscores
        ]);
    }

    #[Route('/hiscore/difficulty/{id}', methods: ['GET'], name: 'app_hiscore_difficulty')]
    public function difficultyFilter($id): Response
    {
        $hiscores = $this->hiscoreRepository->findBy(['difficulty'=>$id,'moderated'=>true,'deleted'=>false],['score'=>'DESC']);
        return $this->render('hiscore/filter.html.twig', [
            'hiscores' => $hiscores
        ]);
    }
}
