<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Purchase
 *
 * @ORM\Table(name="purchase", indexes={@ORM\Index(name="IDX_6117D13B4ACC9A20", columns={"card_id"})})
 * @ORM\Entity
 */
class Purchase
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var \Card
     *
     * @ORM\ManyToOne(targetEntity="Card")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="card_id", referencedColumnName="id")
     * })
     */
    private $card;


}
