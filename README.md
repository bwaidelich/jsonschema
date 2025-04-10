# JSON Schema

PHP Classes to represent JSON Schemas, see [JSON Schema](https://json-schema.org/)

## Usage

This package can be installed via [composer](https://getcomposer.org):

```bash
composer require wwwision/jsonschema
```

With that, you can define a JSON Schema in PHP:

```php
$schema = new ObjectSchema(
    title: 'Product',
    description: 'A product in the catalog',
    properties: ObjectProperties::create(
        id: new StringSchema(
            title: 'ID',
            description: 'The unique identifier for a product',
            format: StringFormat::uuid,
        ),
        title: new StringSchema(
            title: 'Product title',
            description: 'The name of the product',
        ),
        available: new BooleanSchema(
            title: 'Whether the product is available',
        ),
        price: new NumberSchema(
            title: 'Price',
            description: 'The price of the product',
            default: 0.0,
            minimum: 0.0,
        )
    )
);

$expected = <<<JSON
{
    "type": "object",
    "title": "Product",
    "description": "A product in the catalog",
    "properties": {
        "id": {
            "type": "string",
            "title": "ID",
            "description": "The unique identifier for a product",
            "format": "uuid"
        },
        "title": {
            "type": "string",
            "title": "Product title",
            "description": "The name of the product"
        },
        "available": {
            "type": "boolean",
            "title": "Whether the product is available"
        },
        "price": {
            "type": "number",
            "title": "Price",
            "description": "The price of the product",
            "default": 0,
            "minimum": 0
        }
    }
}
JSON;

assert(json_encode($schema, JSON_PRETTY_PRINT) === $expected);
```

## Contribution

Contributions in the form of [issues](https://github.com/bwaidelich/jsonschema/issues) or [pull requests](https://github.com/bwaidelich/jsonschema/pulls) are highly appreciated

## License

See [LICENSE](./LICENSE)