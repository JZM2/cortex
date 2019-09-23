<?php
/**
 * Created by PhpStorm.
 * User: Honza
 */

namespace App\Classes;


use App\Repository\ReportTopCustomersRepository;
use Doctrine\ORM\EntityManager;
use App\Entity\Customer;
use phpDocumentor\Reflection\Types\Mixed_;

class Report
{
    /** @var EntityManager $em */
    private $em;

    /** @var int $cntCustomers */
    private $cntCustomers = 0;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    /**
     * @return int
     */
    public function getCntCustomers(): int
    {
        $query = $this->em->getRepository(Customer::class)->createQueryBuilder('c');
        $query
            ->select('COUNT (c.id) AS cntCustomers')
        ;

        $findCustomers = $query->getQuery()->getResult();

        return $findCustomers[0]['cntCustomers'];
    }

    public function getTopCustomer(): array
    {
        $query = $this->em->createQuery('SELECT * FROM reporttopcustomers');

        $stmt = $this->em->getConnection()->prepare('SELECT * FROM reporttopcustomers');
        $stmt->execute();

        $topCustomers = $stmt->fetchAll();

        return $topCustomers;
    }
}