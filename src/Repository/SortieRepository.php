<?php

namespace App\Repository;

use App\Entity\Campus;
use App\Entity\Etat;
use App\Entity\Participant;
use App\Entity\Sortie;
use App\Models\Filtres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

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

    public function findModifSortie(int $id)
    {
        // version queryBuilder
        $queryBuilder=$this->createQueryBuilder('s')
            ->leftJoin('s.siteOrganisateur', 'site')
            ->leftJoin('s.lieuSortie', 'lieu')
            ->addSelect('site', 'lieu')
            ->where('s.id = :id')
            ->setParameter('id', $id);

        $query = $queryBuilder->getQuery();

        return $query->getOneOrNullResult();
    }

    public function findSortieHome(Filtres $filtres){
        $queryBuilder = $this->createQueryBuilder('s');
        $expr = $queryBuilder->expr();
        $queryBuilder
            ->leftJoin('s.organisateur', 'orga')
            ->leftJoin('s.etatSortie', 'etat')
            ->addSelect('etat', 'orga')
            ->where($expr->neq('etat.libelle','\'Historisée\''))
            ->andWhere('s.siteOrganisateur = :campus')
            ->setParameter('campus', $filtres->getCampus())
            ->andWhere('etat.libelle != \'En création\' OR (etat.libelle = \'En création\' AND s.organisateur = :user)')
            ->andWhere(
                $expr->orX(
                    $expr->andX(
                        $expr->eq('etat.libelle','\'En création\''),
                        $expr->eq('s.organisateur', ':user')
                    ),
                    $expr->neq('etat.libelle','\'En création\'')
                )
            );
        //motcle
        if($filtres->getSearch()){
            $queryBuilder->andWhere('s.nom LIKE :motCle')
                ->setParameter('motCle','%'.$filtres->getSearch().'%');
        }
        //date debut
        /*if($filtres->getDateDebut()){
            $queryBuilder->andWhere('s.dateHeureDebut >= :dateDebut')
                ->setParameter('dateDebut', $filtres->getDateDebut());
        }*/
        //date fin
        /*if($filtres->getDateFin()){
            $queryBuilder->andWhere('s.dateHeureDebut >= :dateFin')
                ->setParameter('dateFin', $filtres->getDateFin());
        }*/
        //organisateur
        if($filtres->getEstOrganisateur()){
            $queryBuilder->andWhere('s.organisateur = :user');
        }
        //sorties passées
        if($filtres->getEstPasse()){
            $queryBuilder->andWhere('etat.libelle = \'Terminée\'');
        }
        //est inscrit
        if($filtres->getEstInscrit()){
            $queryBuilder->andWhere(':user MEMBER OF s.participants');
        }
        // pas inscrit
        if ($filtres->getPasInscrit()){
            $queryBuilder->andWhere(':user NOT MEMBER OF s.participants');
        }
        $queryBuilder->setParameter('user', $filtres->getUtilisateurActuel());
        return $queryBuilder->getQuery()->getResult();
    }

    public function findOuvertToCloture(){
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder
            ->leftJoin('s.etatSortie', 'etat')
            ->addSelect('etat')
            ->where('etat.libelle = \'Ouverte\'')
            ->andWhere('s.dateLimiteInscription < CURRENT_DATE()');
        return $queryBuilder->getQuery()->getResult();
    }

    public function findClotureToEnCours(){
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder
            ->leftJoin('s.etatSortie', 'etat')
            ->addSelect('etat')
            ->where('etat.libelle = \'Clôturée\'')
            ->andWhere('s.dateHeureDebut <= CURRENT_DATE()');
        return $queryBuilder->getQuery()->getResult();
    }

    public function findEnCoursToTermine(){
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder
            ->leftJoin('s.etatSortie', 'etat')
            ->addSelect('etat')
            ->where('etat.libelle = \'En cours\'')
            ->andWhere('DATE_ADD(s.dateHeureDebut, s.duree, \'MINUTE\') <= CURRENT_DATE()');
        return $queryBuilder->getQuery()->getResult();
    }

    public function findTermineAndAnnulerToHistorise(){
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder
            ->leftJoin('s.etatSortie', 'etat')
            ->addSelect('etat')
            ->where('etat.libelle = \'En cours\' OR etat.libelle = \'Annulée\'')
            ->andWhere('DATE_ADD(s.dateHeureDebut, 1, \'MONTH\') < CURRENT_DATE()');
        return $queryBuilder->getQuery()->getResult();
    }
}
