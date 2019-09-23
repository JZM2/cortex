<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Card
 *
 * @ORM\Table(name="card")
 * @ORM\Entity
 */
class Card
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="typ", type="string", length=50, nullable=false)
     */
    private $typ;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Customer", inversedBy="card")
     * @ORM\JoinTable(name="card_customer",
     *   joinColumns={
     *     @ORM\JoinColumn(name="card_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     *   }
     * )
     */
    private $customer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->customer = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
