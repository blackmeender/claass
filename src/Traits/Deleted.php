<?php

namespace Php2\Traits;

use Php2\Date\DateTime;


trait Deleted
{
    private DateTime $deletedAt;

    public function getDeletedAt(): DateTime
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
