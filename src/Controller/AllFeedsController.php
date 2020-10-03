<?php

namespace App\Controller;

use App\Entity\Feeds;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllFeedsController extends FeedController
{
    /**
     * @var array
     */
    private $feeds= [];
    /**
     * @Route("/feed/all/", name="all_feeds")
     * @return Response
     */
    public function AllFeedAction(): Response
    {
        $this->getgetAllFedds();
        return $this->render('all_feeds/index.html.twig', [
            'links' => $this->feedNavLinks(),
            'feeds' => $this->feeds
        ]);
    }


    private function getgetAllFedds(): void
    {
        $query= $this->getDoctrine()->getRepository(Feeds::class);
        $feeds= $query->findAll();

        if (empty($feeds)) {
            $this->addFlash('warning', 'ziadne linky');
        }
        $this->feeds= $feeds;
    }
}
