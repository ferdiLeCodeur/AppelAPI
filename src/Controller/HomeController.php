<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(CallApiService $callApiService): Response
    {
        $page = $callApiService->getFranceData();
        return $this->render('home/index.html.twig', [
            'data'=> $page,
        ]);
    }

    //_______________________________________________________________________
    #[Route('/page/{numPage}', name: 'pages')]
    public function page(CallApiService $callApiService, int $numPage = 1): Response
    {

        $elementPage = 20;

        if($numPage < 1){
            $numPage = 1;
        }

        $data = $callApiService->getFranceData();

        $currentPage = ($elementPage * ($numPage-1));
        //dump($currentPage);
        //dd($page[1]['title']);// titre du 1er tableau


        $cutPage =array_chunk($data,20);
        //dd($cutPage[$numPage-1]);
        $pageDatas = $cutPage[$numPage-1];

        //_________________return____________________________________________

        return $this->render('pages/index.html.twig', [
            'numPage'=> $numPage,
            'pageDatas' => $pageDatas,


        ]);
    }
}
