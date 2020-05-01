<?php

namespace Bolt\Example\Dashboard\Core\Application\Service\GetReviewCardNumber;

class GetReviewCardNumberService
{
    protected $repository;

    public function __construct(BukuRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute($idBuku)
    {
        try {
		$bukuEntity = new \Buku();
		$bukuEntity->setID($idBuku);

		$buku = $this->repository->findBuku($bukuEntity);
		if(!$buku->isValid()) {
			throw new \BukuNotValidException(‘Buku tidak valid’);
}
        } catch (\Exception $exception) {
		throw new \Exception();
        }

        return $buku;
    }
}
