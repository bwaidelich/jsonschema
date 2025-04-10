<?php

declare(strict_types=1);

namespace Wwwision\JsonSchema;

/**
 * @see https://json-schema.org/understanding-json-schema/reference/string
 */
final class StringSchema implements SchemaWithDescription
{
    /**
     * @param array<string>|null $examples
     * @param array<string>|null $enum
     */
    public function __construct(
        public readonly null|string $title = null,
        public readonly null|string $description = null,
        public readonly null|string $default = null,
        public readonly null|array $examples = null,
        public readonly null|bool $readOnly = null,
        public readonly null|bool $writeOnly = null,
        public readonly null|bool $deprecated = null,
        public readonly null|string $comment = null,
        public readonly null|array $enum = null,
        public readonly null|string $const = null,
        public readonly null|int $minLength = null,
        public readonly null|int $maxLength = null,
        public readonly null|StringFormat $format = null,
        public readonly null|string $pattern = null,
        public readonly null|string $contentMediaType = null,
        public readonly null|string $contentEncoding = null,
    ) {}

    /**
     * @param array<string>|null $examples
     * @param array<string>|null $enum
     */
    public function with(
        null|string $title = null,
        null|string $description = null,
        null|string $default = null,
        null|array $examples = null,
        null|bool $readOnly = null,
        null|bool $writeOnly = null,
        null|bool $deprecated = null,
        null|string $comment = null,
        null|array $enum = null,
        null|string $const = null,
        null|int $minLength = null,
        null|int $maxLength = null,
        null|StringFormat $format = null,
        null|string $pattern = null,
        null|string $contentMediaType = null,
        null|string $contentEncoding = null,
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
            $minLength ?? $this->minLength,
            $maxLength ?? $this->maxLength,
            $format ?? $this->format,
            $pattern ?? $this->pattern,
            $contentMediaType ?? $this->contentMediaType,
            $contentEncoding ?? $this->contentEncoding,
        );
    }

    public function withDescription(string $description): self
    {
        return $this->with(description: $description);
    }

    public function jsonSerialize(): array
    {
        $array = [
            'type' => 'string',
            ...array_filter(get_object_vars($this), static fn($v) => $v !== null),
        ];
        if ($this->comment) {
            unset($array['comment']);
            $array['$comment'] = $this->comment;
        }
        if ($this->format !== null) {
            $array['format'] = $this->format->name;
        }
        return $array;
    }
}
