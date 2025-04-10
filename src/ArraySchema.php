<?php

declare(strict_types=1);

namespace Wwwision\JsonSchema;

use Webmozart\Assert\Assert;

/**
 * @see https://json-schema.org/understanding-json-schema/reference/array
 */
final class ArraySchema implements SchemaWithDescription
{
    /**
     * @param array<mixed>|null $default
     * @param array<array<mixed>>|null $examples
     * @param array<mixed>|null $const
     */
    public function __construct(
        public readonly null|string $title = null,
        public readonly null|string $description = null,
        public readonly null|array $default = null,
        public readonly null|array $examples = null,
        public readonly null|bool $readOnly = null,
        public readonly null|bool $writeOnly = null,
        public readonly null|bool $deprecated = null,
        public readonly null|string $comment = null,
        public readonly null|array $const = null,
        public readonly Schema|false|null $items = null,
        public readonly null|ArrayItems $prefixItems = null,
        public readonly ArrayItems|false|Schema|null $unevaluatedItems = null,
        public readonly null|Schema $contains = null,
        public readonly null|int $minContains = null,
        public readonly null|int $maxContains = null,
        public readonly null|int $minItems = null,
        public readonly null|int $maxItems = null,
        public readonly null|bool $uniqueItems = null,
    ) {
        if ($this->contains === null) {
            Assert::null($this->minContains, '"minContains" can only be used if "contains" is defined');
            Assert::null($this->maxContains, '"maxContains" can only be used if "contains" is defined');
        }
    }

    /**
     * @param array<mixed>|null $default
     * @param array<array<mixed>>|null $examples
     * @param array<mixed>|null $const
     */
    public function with(
        null|string $title = null,
        null|string $description = null,
        null|array $default = null,
        null|array $examples = null,
        null|bool $readOnly = null,
        null|bool $writeOnly = null,
        null|bool $deprecated = null,
        null|string $comment = null,
        null|array $const = null,
        Schema|false|null $items = null,
        null|ArrayItems $prefixItems = null,
        ArrayItems|false|Schema|null $unevaluatedItems = null,
        null|Schema $contains = null,
        null|int $minContains = null,
        null|int $maxContains = null,
        null|int $minItems = null,
        null|int $maxItems = null,
        null|bool $uniqueItems = null,
    ): self {
        return new self(
            $title ?? $this->title,
            $description ?? $this->description,
            $default ?? $this->default,
            $examples ?? $this->examples,
            $readOnly ?? $this->readOnly,
            $writeOnly ?? $this->writeOnly,
            $deprecated ?? $this->deprecated,
            $comment ?? $this->comment,
            $const ?? $this->const,
            $items ?? $this->items,
            $prefixItems ?? $this->prefixItems,
            $unevaluatedItems ?? $this->unevaluatedItems,
            $contains ?? $this->contains,
            $minContains ?? $this->minContains,
            $maxContains ?? $this->maxContains,
            $minItems ?? $this->minItems,
            $maxItems ?? $this->maxItems,
            $uniqueItems ?? $this->uniqueItems,
        );
    }

    public function withDescription(string $description): self
    {
        return $this->with(description: $description);
    }

    public function jsonSerialize(): array
    {
        $array = [
            'type' => 'array',
            ...array_filter(get_object_vars($this), static fn($v) => $v !== null),
        ];
        if ($this->comment) {
            unset($array['comment']);
            $array['$comment'] = $this->comment;
        }
        return $array;
    }
}
