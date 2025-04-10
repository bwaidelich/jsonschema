<?php

declare(strict_types=1);

namespace Wwwision\JsonSchema;

final class Discriminator
{
    /**
     * @param array<string,string>|null $mapping
     */
    public function __construct(
        public string $propertyName,
        public array|null $mapping,
    ) {}

}
