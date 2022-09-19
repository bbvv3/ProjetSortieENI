<?php

namespace App\Repository;

use App\Models\RechercherSortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RechercherSortie>
 *
 * @method RechercherSortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method RechercherSortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method RechercherSortie[]    findAll()
 * @method RechercherSortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RechercherSortieRepository extends ServiceEntityRepository
{
    private CampusRepository $campusRepository;
    private EtatRepository $etatRepository;
    private LieuRepository $lieuRepository;
    private ParticipantRepository $participantRepository;
    private SortieRepository $sortieRepository;
    private VilleRepository $villeRepository;

    public function __construct(CampusRepository $campusRepository, EtatRepository $etatRepository, LieuRepository $lieuRepository,
                                ParticipantRepository $participantRepository, SortieRepository $sortieRepository, VilleRepository $villeRepository, ManagerRegistry $registry)
    {
        parent::__construct($registry, RechercherSortie::class);
    }

    public function add(RechercherSortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RechercherSortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //public function rechercher($rechercherSortie)
    //{
    //    $queryBuilder = $this->createQueryBuilder(r);

    //    if($rechercherSortie->getCampus() !== null) {
    //        $queryBuilder
    //            ->where("r.campus = :campus")
    //            ->setParameter("campus", $rechercherSortie->getCampus())
    //            ;
    //    }

        //{
        //    return $this->createQueryBuilder('f')
        //        ->leftJoin('f.campus', 'c')

        //        ->where('c.nom' = )
        //}

        //$queryBuilder->leftJoin('r.sorties', 'rechSortie');
        //$queryBuilder->where('r.campus = :campus');


        //$queryBuilder->andWhere('r.dateDebut')
        //$queryBuilder->andWhere('r.dateFin');
        //$queryBuilder->andWhere('r.sortiesOrga');
        //$queryBuilder->andWhere('r.sortiesInscrit');
        //$queryBuilder->andWhere('r.sortiesNonInscrit');
        //$queryBuilder->andWhere('r.sortiesPassee');

    //    $query = $queryBuilder->getQuery();
    //    $results = $query->getResult();
    //    return $results;
    //}







    //    public function findByEmailOrPseudo(string $mailOrPseudo)
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->where('u.mail = :mailOrPseudo')
    //            ->orWhere('u.pseudo = :mailOrPseudo')
    //            ->setParameter('mailOrPseudo', $mailOrPseudo)
    //            ->getQuery()
    //            ->getOneOrNullResult();
    //    }




//    /**
//     * @return RechercherSortie[] Returns an array of RechercherSortie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RechercherSortie
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
