<?php

namespace Php2\Traits;

trait Active
{
    private bool $active  = true;

    public function active(): bool
    {
        return $this->active;
    }
    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }
}
