<?php

namespace Php2\Date;

use Php2\Enums\Date;
use DateTimeImmutable;

class DateTime extends DateTimeImmutable
{
    public function __toString(): string
    {
        return $this->format(Date::DATETIME_FORMAT->value);
    }
}
