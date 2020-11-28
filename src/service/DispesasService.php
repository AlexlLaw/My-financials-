<?php


namespace App\service;


use App\Entity\Dispesas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DispesasService extends AbstractController implements DispesasServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * DispesasController constructor.
     * @param EntityManagerInterface $entityManager
     * @param DispesasService $dispesasService
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $json
     * @return Dispesas
     */
    public function montarDispesas(string $json): Dispesas
    {
        $dados = json_decode($json);

        $dispesas = new Dispesas();
        $dispesas->setNome($dados->nome);
        $dispesas->setData($dados->data);
        $dispesas->setValor($dados->valor);
        $dispesas->setFixa($dados->fixa);
        $dispesas->setTempo($dados->tempo);

        return $dispesas;
    }

    /**
     * @param Dispesas $dispesas
     */
    public function createDispesa(string $request): void
    {
        $dispesas =  $this->montarDispesas($request);
        $this->entityManager->persist($dispesas);
        $this->entityManager->flush();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function buscarDispesas(int $id): ?Dispesas
    {
        $repositorioDispesas = $this
            ->getDoctrine()
            ->getRepository(dispesas::class);
        $dispesas = $repositorioDispesas->find($id);

        return $dispesas;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $repositorioDispesas = $this
            ->getDoctrine()
            ->getRepository(dispesas::class);
        $dispesasList = $repositorioDispesas->findAll();

        return $dispesasList;
    }

    /**
     * @param Dispesas $dispesasExistente
     * @param Dispesas $dispesasEnviadas
     * @return Dispesas
     */
    public function update(int $id, string $request)
    {
        $dispesasEnviadas =  $this->montarDispesas($request);
        $dispesasExistente = $this->buscarDispesas($id);

        if (is_null($dispesasExistente)) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }
        $dispesasExistente->setNome($dispesasEnviadas->getNome());
        $dispesasExistente->setData($dispesasEnviadas->getData());
        $dispesasExistente->setValor($dispesasEnviadas->getValor());
        $dispesasExistente->setFixa($dispesasEnviadas->getFixa());
        $dispesasExistente->setTempo($dispesasEnviadas->getTempo());

        $this->entityManager->flush();

       return $dispesasExistente;
    }

    /**
     * @param int $id
     */
    public function removeDispesa(int $id): void
    {
        $dispesa =  $this->buscarDispesas($id);
        $this->entityManager->remove($dispesa);
        $this->entityManager->flush();
    }

}
