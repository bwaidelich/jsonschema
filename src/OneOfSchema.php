<?php

declare(strict_types=1);

namespace Wwwision\JsonSchema;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * @see https://json-schema.org/understanding-json-schema/reference/combining#oneof
 * @implements IteratorAggregate<Schema>
 */
final class OneOfSchema implements IteratorAggregate, Schema
{
    /**
     * @param array<Schema> $items
     */
    private function __construct(
        private readonly array $items,
        public readonly Discriminator|null $discriminator,
    ) {}

    public static function create(Schema ...$items): self
    {
        return new self($items, null);
    }

    public function withDiscriminator(Discriminator $discriminator): self
    {
        return new self($this->items, $discriminator);
    }

    public function jsonSerialize(): array
    {
        $result = [
            'oneOf' => $this->items,
        ];
        if ($this->discriminator !== null) {
            $result['discriminator'] = $this->discriminator;
        }
        return $result;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}
