<?php

declare(strict_types=1);

namespace Wwwision\JsonSchema;

/**
 * @see https://json-schema.org/understanding-json-schema/reference/boolean
 */
final class BooleanSchema implements SchemaWithDescription
{
    /**
     * @param array<bool>|null $examples
     */
    public function __construct(
        public readonly null|string $title = null,
        public readonly null|string $description = null,
        public readonly null|bool $default = null,
        public readonly null|array $examples = null,
        public readonly null|bool $readOnly = null,
        public readonly null|bool $writeOnly = null,
        public readonly null|bool $deprecated = null,
        public readonly null|string $comment = null,
        public readonly null|bool $const = null,
    ) {}

    /**
     * @param array<bool>|null $examples
     */
    public function with(
        null|string $title = null,
        null|string $description = null,
        null|bool $default = null,
        null|array $examples = null,
        null|bool $readOnly = null,
        null|bool $writeOnly = null,
        null|bool $deprecated = null,
        null|string $comment = null,
        null|bool $const = null,
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
        );
    }

    public function withDescription(string $description): self
    {
        return $this->with(description: $description);
    }

    public function jsonSerialize(): array
    {
        $array = [
            'type' => 'boolean',
            ...array_filter(get_object_vars($this), static fn($v) => $v !== null),
        ];
        if ($this->comment) {
            unset($array['comment']);
            $array['$comment'] = $this->comment;
        }
        return $array;
    }
}
