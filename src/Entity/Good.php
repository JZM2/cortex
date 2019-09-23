<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Good
 *
 * @ORM\Table(name="good", indexes={@ORM\Index(name="IDX_6C844E92558FBEB9", columns={"purchase_id"})})
 * @ORM\Entity
 */
class Good
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var \Purchase
     *
     * @ORM\ManyToOne(targetEntity="Purchase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="purchase_id", referencedColumnName="id")
     * })
     */
    private $purchase;


}
