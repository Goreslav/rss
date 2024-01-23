<?php
namespace App\Controller;

use App\Entity\Feeds;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteFeedsController extends FeedController
{
    private const FAVORITE_STATUS = 'favorite';
    private const EMPTY_FEED_MESSAGE = 'ziadne linky';

    /**
     * @Route("/feed/favorite/", name="favorite_feeds")
     */
    public function index()
    {
        return $this->render('favorite_feeds/index.html.twig', [
            'links' => $this->feedNavLinks(),
            'feeds'=> $this->getAllFavoriteFeeds()
        ]);
    }

    private function getAllFavoriteFeeds(): array
    {
        $query = $this->getDoctrine()->getRepository(Feeds::class);
        $feeds = $query->findBy(['status' => self::FAVORITE_STATUS]);

        if (empty($feeds)) {
            $this->addFlash('warning', self::EMPTY_FEED_MESSAGE);
        }

        return $feeds;
    }
}
