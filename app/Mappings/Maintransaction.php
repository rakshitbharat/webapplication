<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Maintransaction
 *
 * @ORM\Table(name="mainTransaction")
 * @ORM\Entity
 */
class Maintransaction
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
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="debit", type="decimal", precision=19, nullable=true)
     */
    private $debit;

    /**
     * @var string
     *
     * @ORM\Column(name="credit", type="decimal", precision=19, nullable=true)
     */
    private $credit;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="accountId", referencedColumnName="id")
     * })
     */
    private $accountId;

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

    /**
     * @var string
     *
     * @ORM\Column(name="transactionCode", type="string", length=255)
     */
    private $transactionCode;

}

