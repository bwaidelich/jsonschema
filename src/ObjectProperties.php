<?php

declare(strict_types=1);

namespace Wwwision\JsonSchema;

use ArrayIterator;
use IteratorAggregate;
use JsonSerializable;
use Traversable;
use Webmozart\Assert\Assert;

/**
 * @see https://json-schema.org/understanding-json-schema/reference/object#properties
 * @implements IteratorAggregate<Schema>
 */
final class ObjectProperties implements IteratorAggregate, JsonSerializable
{
    /**
     * @param array<string, Schema> $properties
     */
    private function __construct(
        private readonly array $properties,
    ) {}

    public static function create(Schema ...$properties): self
    {
        Assert::isMap($properties, 'Properties has to be a map with string keys');
        return new self($properties);
    }

    /**
     * @return array<string>
     */
    public function names(): array
    {
        return array_keys($this->properties);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->properties);
    }

    /**
     * @return object{string: Schema}
     */
    public function jsonSerialize(): object
    {
        return (object) $this->properties; // @phpstan-ignore return.type
    }
}
