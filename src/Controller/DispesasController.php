<?php

namespace App\Controller;

use App\Entity\Dispesas;
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
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * DispesasController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route ("/dispesas", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $content = $request->getContent();
        $dados = json_decode($content);

        $dispesas = new Dispesas();
        $dispesas->setNome($dados->nome);
        $dispesas->setData($dados->data);
        $dispesas->setValor($dados->valor);
        $dispesas->setFixa($dados->fixa);
        $dispesas->setTempo($dados->tempo);

        $this->entityManager->persist($dispesas);
        $this->entityManager->flush();

        return new JsonResponse($dispesas);
   }

    /**
     * @Route ("/dispesas", methods={"GET"})
     */
    public function findAll(): Response
    {
       $repositorioDispesas =  $this->getDoctrine()->getRepository(dispesas::class);
       $dispesasList = $repositorioDispesas->findAll();

        return new JsonResponse($dispesasList);
    }

    /**
     * @Route ("/dispesas/{id}", methods={"GET"})
     */
    public function findById(int $id): Response
    {
        $repositorioDispesas =  $this->getDoctrine()->getRepository(dispesas::class);
        $dispesas = $repositorioDispesas->find($id);
        $status = is_null($dispesas) ? Response::HTTP_NO_CONTENT : 200;

        return new JsonResponse($dispesas, $status);
    }

    /**
     * @Route ("/dispesas/{id}", methods={"PUT"})
     */
    public function Update(int $id, Request $request): Response
    {
        $content = $request->getContent();
        $dados = json_decode($content);

        $dispesasEnviadas = new Dispesas();
        $dispesasEnviadas->setNome($dados->nome);
        $dispesasEnviadas->setData($dados->data);
        $dispesasEnviadas->setValor($dados->valor);
        $dispesasEnviadas->setFixa($dados->fixa);
        $dispesasEnviadas->setTempo($dados->tempo);

        $repositorioDispesas =  $this->getDoctrine()->getRepository(dispesas::class);
        $dispesasExistente = $repositorioDispesas->find($id);

        if (is_null($dispesasExistente)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $dispesasExistente->setNome($dispesasEnviadas->getNome());
        $dispesasExistente->setData($dispesasEnviadas->getData());
        $dispesasExistente->setValor($dispesasEnviadas->getValor());
        $dispesasExistente->setFixa($dispesasEnviadas->getFixa());
        $dispesasExistente->setTempo($dispesasEnviadas->getTempo());

        $this->entityManager->flush();

        return new JsonResponse($dispesasExistente);
    }
}
