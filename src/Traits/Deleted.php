<?php

namespace Php2\Traits;

use Php2\Date\DateTime;


trait Deleted
{
    private ?DateTime $deletedAt = null;

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTime $deletedAt = null): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function isDeleted($deletedAt)
    {
        return !empty($this->deletedAt);
    }
}
