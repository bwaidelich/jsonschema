<?php

declare(strict_types=1);

namespace Wwwision\JsonSchema;

interface SchemaWithDescription extends Schema
{
    public function withDescription(string $description): self;
}
