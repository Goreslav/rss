<?php

namespace App\Controller;

use App\Entity\Feeds;
use App\Form\FeedType;
use Feed;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedController extends AbstractController
{

    /**
     * @Route("/feed", name="feed")
     */

    public function index()
    {
        return $this->render('feed/index.html.twig', [
            'links' => $this->feedNavLinks()
        ]);
    }

    /**
     * @return array
     */
    protected function feedNavLinks():array
    {
        return [
            'oblubene' => 'favorite_feeds',
            'vsetky' => 'all_feeds',
            'pridaj' => 'add_feed'
        ];
    }
    protected function parseRssFeed($url): array {
        $result =[];
        try {
            $rss = Feed::loadRss($url);
            $result =$rss->toArray();
            return $result;
        } catch (\FeedException $e) {
        }
        return $result;
    }

    /**
     * @param $url
     * @return mixed
     * @throws \Exception
     */
    protected function validateUrl($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \RuntimeException('');
        }
    }

    /**
     * @Route("/feed/edit/", name="feed_edit")
     * @param Request $request
     * @return RedirectResponse
     */
    public function editAction(Request $request): RedirectResponse
    {
        if ($request->request !== null) {
            $formData = $request->request;
            $id = $formData->get('id');
            $decision = $formData->get('decision');
            $entityManager = $this->getDoctrine()->getManager();
            $feed = $entityManager->getRepository(Feeds::class)->find($id);
            if (!$feed) {
                return $this->redirectToRoute('all_feeds',[]);
            }

            if ($decision === 'edit') {
                    return $this->redirect($this->generateUrl('add_feed',['id'=>$id]));
            }

            if ($decision === 'favorite') {
                $feed->setStatus('favorite');
                $entityManager->persist($feed);
            }
            if ($decision === 'delete') {
                $entityManager->remove($feed);
            }

            $entityManager->flush();
            return $this->redirectToRoute('all_feeds',[]);

        }

        else {
            return $this->redirectToRoute('all_feeds',[]);
        }
    }


    /**
     * @Route("/feed/change/", name="change_feed_data")
     * @param Request $request
     * @return RedirectResponse
     */
    public function changeAction(Request $request): Response
    {
        dump($request);
        if ($request->request->get('id') !== null) {
            $formData = $request->request;
            $id = $formData->get('id');
            $link = $formData->get('link');
            $name = $formData->get('name');
            $entityManager = $this->getDoctrine()->getManager();
            $feed = $entityManager->getRepository(Feeds::class)->find($id);

            if (!$feed) {
                throw $this->createNotFoundException(
                    'No product found for id ' . $id
                );
            }
            $feed->setName($name);
            $feed->setLink($link);
            $entityManager->flush();
        }
        return $this->redirectToRoute('all_feeds');
    }

}
