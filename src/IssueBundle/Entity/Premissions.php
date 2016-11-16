<?php

namespace IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Premissions
 *
 * @ORM\Table(name="premissions")
 * @ORM\Entity
 */
class Premissions
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
     * @var integer
     *
     * @ORM\Column(name="id_pr", type="integer", nullable=false)
     */
    private $idPr;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;


}
