<?php

namespace Php2\Traits;

use Php2\Date\DateTime;


trait Updated
{
    private DateTime $updatedAt;


    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }


    public function setUpdatedAt($updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
