<?php

declare(strict_types=1);

namespace Wwwision\JsonSchema;

/**
 * @see https://json-schema.org/understanding-json-schema/reference/numeric#integer
 */
final class IntegerSchema implements SchemaWithDescription
{
    /**
     * @param array<int>|null $examples
     * @param array<int>|null $enum
     */
    public function __construct(
        public readonly null|string $title = null,
        public readonly null|string $description = null,
        public readonly null|int $default = null,
        public readonly null|array $examples = null,
        public readonly null|bool $readOnly = null,
        public readonly null|bool $writeOnly = null,
        public readonly null|bool $deprecated = null,
        public readonly null|string $comment = null,
        public readonly null|array $enum = null,
        public readonly null|int $const = null,
        public readonly null|int $multipleOf = null,
        public readonly null|int $minimum = null,
        public readonly null|bool $exclusiveMinimum = null,
        public readonly null|int $maximum = null,
        public readonly null|bool $exclusiveMaximum = null,
    ) {}

    /**
     * @param array<int>|null $examples
     * @param array<int>|null $enum
     */
    public function with(
        null|string $title = null,
        null|string $description = null,
        null|int $default = null,
        null|array $examples = null,
        null|bool $readOnly = null,
        null|bool $writeOnly = null,
        null|bool $deprecated = null,
        null|string $comment = null,
        null|array $enum = null,
        null|int $const = null,
        null|int $multipleOf = null,
        null|int $minimum = null,
        null|bool $exclusiveMinimum = null,
        null|int $maximum = null,
        null|bool $exclusiveMaximum = null,
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
            $enum ?? $this->enum,
            $const ?? $this->const,
            $multipleOf ?? $this->multipleOf,
            $minimum ?? $this->minimum,
            $exclusiveMinimum ?? $this->exclusiveMinimum,
            $maximum ?? $this->maximum,
            $exclusiveMaximum ?? $this->exclusiveMaximum,
        );
    }

    public function withDescription(string $description): self
    {
        return $this->with(description: $description);
    }

    public function jsonSerialize(): array
    {
        $array = [
            'type' => 'integer',
            ...array_filter(get_object_vars($this), static fn($v) => $v !== null),
        ];
        if ($this->comment) {
            unset($array['comment']);
            $array['$comment'] = $this->comment;
        }
        return $array;
    }
}
