<?php

namespace App\Controller;

use App\Entity\Dispesas;
use App\service\DispesasService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DispesasController
 * @package App\Controller
 *
 */
class DispesasController extends AbstractController
{
    /**
     * @var DispesasService
     */
    private $dispesaService;

    /**
     * DispesasController constructor.
     * @param DispesasService $dispesasService
     */
    public function __construct(
        DispesasService $dispesasService
    ) {
        $this->dispesaService = $dispesasService;
    }

    /**
     * @Route ("/dispesas", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $dispesas = $this->dispesaService->createDispesa($request->getContent());

        return new JsonResponse($dispesas);
    }

    /**
     * @Route ("/dispesas", methods={"GET"})
     */
   public function findAll(): Response
   {
       $dispesasList = $this->dispesaService->findAll();

       return new JsonResponse($dispesasList);
   }

   /**
    * @Route ("/dispesas/{id}", methods={"GET"})
    * @param int $id
    * @return Response
    */
   public function findById(int $id): Response
   {
        $dispesas = $this->dispesaService->buscarDispesas($id);
        $status = is_null($dispesas) ? Response::HTTP_NO_CONTENT : 200;

        return new JsonResponse($dispesas, $status);
   }

   /**
    * @Route ("/dispesas/{id}", methods={"PUT"})
    */
   public function Update(int $id, Request $request): Response
   {
       $dispesasAtualizadas = $this->dispesaService->update($id, $request->getContent());

        return new JsonResponse($dispesasAtualizadas);
   }

   /**
    * @Route ("/dispesas/{id}", methods={"DELETE"})
    * @param int $id
    * @return Response
    */
   public function delete(int $id): Response
   {
       $this->dispesaService->removeDispesa($id);

       return new Response('', Response::HTTP_NO_CONTENT);
   }
}
