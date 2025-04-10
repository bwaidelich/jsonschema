<?php

declare(strict_types=1);

namespace Wwwision\JsonSchema;

/**
 * @see https://json-schema.org/understanding-json-schema/reference/numeric#number
 */
final class NumberSchema implements SchemaWithDescription
{
    /**
     * @param array<int|float>|null $examples
     * @param array<int|float>|null $enum
     */
    public function __construct(
        public readonly null|string $title = null,
        public readonly null|string $description = null,
        public readonly int|float|null $default = null,
        public readonly null|array $examples = null,
        public readonly null|bool $readOnly = null,
        public readonly null|bool $writeOnly = null,
        public readonly null|bool $deprecated = null,
        public readonly null|string $comment = null,
        public readonly null|array $enum = null,
        public readonly int|float|null $const = null,
        public readonly int|float|null $multipleOf = null,
        public readonly int|float|null $minimum = null,
        public readonly null|bool $exclusiveMinimum = null,
        public readonly int|float|null $maximum = null,
        public readonly null|bool $exclusiveMaximum = null,
    ) {}

    /**
     * @param array<int|float>|null $examples
     * @param array<int|float>|null $enum
     */
    public function with(
        null|string $title = null,
        null|string $description = null,
        int|float|null $default = null,
        null|array $examples = null,
        null|bool $readOnly = null,
        null|bool $writeOnly = null,
        null|bool $deprecated = null,
        null|string $comment = null,
        null|array $enum = null,
        int|float|null $const = null,
        int|float|null $multipleOf = null,
        int|float|null $minimum = null,
        null|bool $exclusiveMinimum = null,
        int|float|null $maximum = null,
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
            'type' => 'number',
            ...array_filter(get_object_vars($this), static fn($v) => $v !== null),
        ];
        if ($this->comment) {
            unset($array['comment']);
            $array['$comment'] = $this->comment;
        }
        return $array;
    }
}
