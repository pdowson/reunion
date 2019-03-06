<?php

namespace App\Repository;

use App\Entity\Classmate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Classmate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classmate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classmate[]    findAll()
 * @method Classmate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassmateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Classmate::class);
    }
}
