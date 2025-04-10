<?php

declare(strict_types=1);

namespace Wwwision\JsonSchema;

use Webmozart\Assert\Assert;

/**
 * @see https://json-schema.org/understanding-json-schema/reference/object
 */
final class ObjectSchema implements SchemaWithDescription
{
    /**
     * @param array<mixed>|null $default
     * @param array<array<mixed>>|null $examples
     * @param array<mixed>|null $const
     * @param array<string>|null $required
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
        public readonly null|ObjectProperties $properties = null,
        // TODO add patternProperties
        public readonly null|bool $additionalProperties = null,
        // TODO add unevaluatedProperties
        public readonly null|array $required = null,
        public readonly null|StringSchema $propertyNames = null,
        public readonly null|int $minProperties = null,
        public readonly null|int $maxProperties = null,
        // TODO add dependentRequired https://json-schema.org/understanding-json-schema/reference/conditionals
        // TODO add dependentSchemas https://json-schema.org/understanding-json-schema/reference/conditionals
        // TODO add if-then-else https://json-schema.org/understanding-json-schema/reference/conditionals#ifthenelse
    ) {
        if ($this->required !== null) {
            Assert::notEmpty($this->required);
        }
    }

    /**
     * @param array<mixed>|null $default
     * @param array<array<mixed>>|null $examples
     * @param array<mixed>|null $const
     * @param array<string>|null $required
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
        null|ObjectProperties $properties = null,
        null|bool $additionalProperties = null,
        null|array $required = null,
        null|StringSchema $propertyNames = null,
        null|int $minProperties = null,
        null|int $maxProperties = null,
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
            $properties ?? $this->properties,
            $additionalProperties ?? $this->additionalProperties,
            $required ?? $this->required,
            $propertyNames ?? $this->propertyNames,
            $minProperties ?? $this->minProperties,
            $maxProperties ?? $this->maxProperties,
        );
    }

    public function withDescription(string $description): self
    {
        return $this->with(description: $description);
    }

    public function jsonSerialize(): array
    {
        $array = [
            'type' => 'object',
            ...array_filter(get_object_vars($this), static fn($v) => $v !== null),
        ];
        if ($this->comment !== null) {
            unset($array['comment']);
            $array['$comment'] = $this->comment;
        }
        return $array;
    }
}
