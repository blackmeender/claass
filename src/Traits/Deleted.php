<?php

namespace Php2\Traits;

use DateTimeImmutable;

trait Deleted
{
    private DateTimeImmutable $deletedAt;

    public function getDeletedAt(): DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function isDeleted($deletedAt)
    {
        return !empty($this->deletedAt);
    }
}
