<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadFeedController extends FeedController
{
    /**
     * @Route("/feed/read/", name="read_feed")
     * @param Request $request
     * @return Response
     */
    public function feedDetailAction(Request $request): Response
    {
        $requestData = $request->query->all();

        if ($requestData !== [])
        {
            try {
                $url = $this->ensureUrlIsValid($requestData['url']);
                $feedData = $this->parseRssFeed($url);
                if (!empty($feedData))
                {
                    return $this->render('read_feed/index.html.twig', [
                        'links'=>$this->feedNavLinks(),
                        'feedData' => $feedData,
                    ]);
                }
            } catch (\RuntimeException $exception) {
                // log exception message if required
            }
        }

        return $this->redirectToRoute('all_feeds');
    }
}
