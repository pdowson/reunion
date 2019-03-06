<?php

namespace App\Repository;

use App\Entity\ClassmateYear;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClassmateYear|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassmateYear|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassmateYear[]    findAll()
 * @method ClassmateYear[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassmateYearRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClassmateYear::class);
    }
}
