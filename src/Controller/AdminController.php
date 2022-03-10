<?php

namespace App\Controller;

use App\Repository\HiscoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private $em;
    private $hiscoreRepository;
    public function __construct(EntityManagerInterface $em, HiscoreRepository $hiscoreRepository) 
    {
        $this->em = $em;
        $this->hiscoreRepository = $hiscoreRepository;
    }

    #[Route('/admin', methods: ['GET'], name: 'app_admin')]
    public function index(): Response
    {
        $hiscores = $this->hiscoreRepository->findBy(['deleted'=>false],['score'=>'DESC']);
        return $this->render('admin/index.html.twig', [
            'hiscores' => $hiscores
        ]);
    }

    #[Route('/admin/promotions', methods: ['GET'], name: 'app_admin_promotions')]
    public function promotions(): Response
    {
        $hiscores = $this->hiscoreRepository->findBy(['moderated'=>false,'deleted'=>false],[]);
        return $this->render('admin/promotions.html.twig', [
            'hiscores' => $hiscores
        ]);
    }

    #[Route('/admin/promotions/new/{id}', methods: ['GET'], name: 'app_admin_promotions_new')]
    public function newPromotions($id): Response
    {
        $hiscore = $this->hiscoreRepository->find($id);
        $hiscore->setModerated(true);
        $this->em->persist($hiscore);
        $this->em->flush();
        return $this->redirectToRoute('app_admin_promotions');
    }
}
