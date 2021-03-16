<?php
declare(strict_types=1);

namespace App\Entity\Traits;

trait RessourceId
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user_read","user_details_read","article_details_read","article_read"})
     */
    private int $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}