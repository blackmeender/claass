<?php

namespace Php2\Traits;

use Php2\Date\DateTime;


trait Updated
{
    private ?DateTime $updatedAt = null;


    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }


    public function setUpdatedAt(?DateTime $updatedAt = null): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
