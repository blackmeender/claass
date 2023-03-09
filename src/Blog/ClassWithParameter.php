<?php

namespace Php2\Blog;

class ClassWithParameter
{
    public function __construct(private int $value)
    {

    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }
}