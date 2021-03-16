<?php
declare(strict_types=1);

namespace App\Entity\Traits;

trait Timestapable
{
    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true, options={"default": "CURRENT_TIMESTAMP"})
     * @Groups({"user_read","user_details_read","article_details_read","article_read"})
     */
    private \DateTimeInterface $createdAt;


    //Problem test unitaire ok mais pas fonctionnel
    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true, options={"default": "CURRENT_TIMESTAMP"})
     * @Groups({"user_read","user_details_read","article_details_read","article_read"})
     */
    private ?\DateTimeInterface $updatedAt;



    /**
     * @return \DateTimeInterfaxe
     */
	public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
	}

    //? parceque la variable est nullable ajouter au type
	public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
	}

	public function  setUpdatedAt(?\DateTimeInterface $updatedAt)
    {
		$this->updatedAt = $updatedAt;
        return $this;
	}
 
}