<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Service\JsonResponse;
use App\Repository\PictureRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    public function __construct(private SerializerInterface $serializer) {}

    #[Route('/', name: 'app_get_pictures', methods: ['GET'])]
    public function index(PictureRepository $pictureRepository): Response
    {
        return (new JsonResponse($this->serializer))->json([
            'status_code' => 200,
            'data' => $pictureRepository->findAll(),
        ], "full");
    }

    #[Route('/', name: 'app_post_pictures', methods: ['POST'])]
    public function create(Request $request, PictureRepository $pictureRepository): Response {
        $picture = new Picture();
        $picture->setName("turbo test")->setPictureFile($request->files->all()['picture']);

        dump($picture);

        $pictureRepository->save($picture, true);

        return (new JsonResponse($this->serializer))->json([
            'status_code' => 201,
            'data' => $picture,
        ], "full");
    }
}
