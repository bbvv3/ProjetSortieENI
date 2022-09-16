<?php

namespace App\Repository;

use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sortie>
 *
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    public function add(Sortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Sortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findModifSortie()

    {
        $entityManager=$this->getEntityManager();
        $dql="
            SELECT s
               FROM App\Entity\Sortie s      
        ";
        $query=$entityManager->createQuery($dql);
        $results= $query->getResult();
        // version queryBuilder

        $queryBuilder=$this->createQueryBuilder('s');
        $queryBuilder->andWhere('s.nom');
        $queryBuilder->andWhere('s.dateHeureDebut');
        $queryBuilder->andWhere('s.dateLimiteInscription');
        $queryBuilder->andWhere('s.duree');
        $queryBuilder->andWhere('s.nbInscriptionsMax');
        $queryBuilder->andWhere('s.infosSortie');
        $queryBuilder->andWhere('s.siteOrganisateur');
        $queryBuilder->andWhere('s.lieuSortie');
        $query=$queryBuilder->getQuery();


        return $results;

    }
}
