<?php

namespace Php2\Traits;

use DateTimeImmutable;

trait Updated
{
    private DateTimeImmutable $updatedAt;


    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }


    public function setUpdatedAt($updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
