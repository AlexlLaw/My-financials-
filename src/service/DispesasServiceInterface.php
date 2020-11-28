<?php


namespace App\service;


use App\Entity\Dispesas;
use Doctrine\ORM\EntityManagerInterface;

interface DispesasServiceInterface
{
    /**
     * DispesasServiceInterface constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager);

    /**
     * @param string $json
     * @return Dispesas
     */
    public function montarDispesas(string $json): Dispesas;

    /**
     * @param string $request
     */
    public function createDispesa(string $request): void;

    /**
     * @param int $id
     * @return Dispesas|null
     */
    public function buscarDispesas(int $id): ?Dispesas;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @param string $request
     */
    public function update(int $id, string $request);

    /**
     * @param int $id
     */
    public function removeDispesa(int $id): void;
}
