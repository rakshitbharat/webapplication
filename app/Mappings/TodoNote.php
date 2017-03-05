<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * TodoNote
 *
 * @ORM\Table(name="todoNote")
 * @ORM\Entity
 */
class TodoNote
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text" , nullable=false)
     */
    private $description;

    /**
     * @var \integer
     *
     * @ORM\ManyToOne(targetEntity="App\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userId", referencedColumnName="id")
     * })
     */
    private $userid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;

}

