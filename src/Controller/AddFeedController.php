<?php

namespace App\Controller;

use App\Entity\Feeds;
use App\Form\FeedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddFeedController extends FeedController
{
    /**
     * @Route("/feed/add/", name="add_feed")
     * @param Request $request
     * @return Response
     */
    public function addFeedAction(Request $request): Response
    {
        $id='';
        $name = '';
        $link = '';
        if (($request->query !== null) && $request->query->all()!== []) {
            $formData = $request->query;
            $id = $formData->all()['id'];
            $entityManager = $this->getDoctrine()->getManager();
            $feed = $entityManager->getRepository(Feeds::class)->find($id);
            if ($feed!== null && !empty($feed) ) {
                $name = $feed->getName();
                $link = $feed->getLink();
            }

        }

        $feed = new Feeds();
        $form = $this->createForm(FeedType::class, $feed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            try {
              $this->validateUrl($feed->getLink());


                $em = $this->getDoctrine()->getManager();
                $em->persist($feed);
                $em->flush();

                $this->addFlash('success', 'link pridany');
                unset($feed, $form);
                $feed = new Feeds();
                $form = $this->createForm(FeedType::class, $feed);

            } catch (\Exception $e) {
                $this->addFlash('success', 'bad url');
            }

            $this->redirect('add_feed');
        }
        return $this->render('add_feed/index.html.twig', [
            'links' => $this->feedNavLinks(),
            'form' => $form->createView(),
            'id'=>$id,
            'name'=> $name,
            'link'=> $link
        ]);
    }

}
