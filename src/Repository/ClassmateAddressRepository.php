<?php

namespace App\Repository;

use App\Entity\ClassmateAddress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClassmateAddress|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassmateAddress|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassmateAddress[]    findAll()
 * @method ClassmateAddress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassmateAddressRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClassmateAddress::class);
    }
}
