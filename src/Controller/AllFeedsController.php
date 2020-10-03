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
    private $allFeeds= [];
    /**
     * @Route("/feed/all/", name="all_feeds")
     * @return Response
     */
    public function AllFeedAction(): Response
    {
        $this->getAllFeeds();
        return $this->render('all_feeds/index.html.twig', [
            'links' => $this->feedNavLinks(),
            'feeds' =>$this->allFeeds,
        ]);
    }

    private function getAllFeeds(): void
    {
        $query= $this->getDoctrine()->getRepository(Feeds::class);
        $feeds= $query->findAll();

        if (empty($feeds)) {
            $this->addFlash('warning', 'ziadne linky');
        }
        $this->allFeeds= $feeds;
    }

}
