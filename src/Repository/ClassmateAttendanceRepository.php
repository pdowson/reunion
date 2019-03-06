<?php

namespace App\Repository;

use App\Entity\ClassmateAttendance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClassmateAttendance|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassmateAttendance|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassmateAttendance[]    findAll()
 * @method ClassmateAttendance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassmateAttendanceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClassmateAttendance::class);
    }
}
