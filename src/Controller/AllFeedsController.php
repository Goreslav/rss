<?php
namespace App\Controller;
use App\Entity\Feeds;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class AllFeedsController extends FeedController
{
    private const FLASH_CATEGORY_WARNING = 'warning';
    private const FLASH_MESSAGE_EMPTY_LINKS = 'ziadne linky';
    /**
     * @var array
     */
    private $allFeeds= [];
    /**
     * @Route("/feed/all/", name="all_feeds")
     * @return Response
     */
    public function allFeedAction(): Response
    {
        $this->updateAllFeedsWithUserFeeds();
        $this->checkFeedsAndAddFlashMessageIfNeeded();
        return $this->render('all_feeds/index.html.twig', [
            'links' => $this->feedNavLinks(),
            'feeds' =>$this->allFeeds,
        ]);
    }
    private function updateAllFeedsWithUserFeeds(): void
    {
        $query= $this->getDoctrine()->getRepository(Feeds::class);
        $feeds= $query->findBy(['userId'=>$this->getUser()->getId()]);
        $this->allFeeds= $feeds;
    }
    private function checkFeedsAndAddFlashMessageIfNeeded(): void
    {
        if (empty($this->allFeeds)) {
            $this->addFlash(self::FLASH_CATEGORY_WARNING, self::FLASH_MESSAGE_EMPTY_LINKS);
        }
    }
}