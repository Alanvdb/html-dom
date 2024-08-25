# HTML DOM

A PHP library for manipulating HTML DOM structures.

## Overview

The `alanvdb/html-dom` library provides a set of tools for working with HTML DOM in PHP. This library allows you to load HTML, traverse and manipulate DOM elements, and query elements using XPath. It is designed to simplify DOM manipulation tasks in PHP applications.

The main components of this library include:

1. **HtmlDomFactory**: Creates and configures DOMDocument and DOMXPath instances from provided HTML strings.
2. **HtmlDomParser**: Provides methods for querying and manipulating an HTML DOM using XPath.

## Installation

To install the library, use Composer:

```bash
composer require alanvdb/html-dom
```

## Usage

### Creating and Using the DOMDocument

The `HtmlDomFactory` class allows you to create a `DOMDocument` from an HTML string. You can then use this `DOMDocument` to perform various operations on the DOM.

#### Example

```php
use AlanVdb\Html\Factory\HtmlDomFactory;

$factory = new HtmlDomFactory();
$domDocument = $factory->createHtmlDomDocument('<div id="test">Hello World</div>');
```

### Querying the DOM with XPath

The `HtmlDomParser` class enables you to query the DOM using XPath expressions. You can retrieve elements by ID, class name, or tag name, and perform more complex queries.

#### Example

```php
use AlanVdb\Html\Factory\HtmlDomFactory;
use AlanVdb\Html\HtmlDomParser;

$factory = new HtmlDomFactory();
$parser = $factory->createHtmlDomParserFromHtml('<div id="test">Hello World</div>');

$element = $parser->getFirstElementWithId('test');
echo $element->textContent; // Outputs: Hello World
```

### Using the HtmlDomFactory

The `HtmlDomFactory` simplifies the creation of `DOMDocument`, `DOMXPath`, and `HtmlDomParser` instances.

#### Example

```php
use AlanVdb\Html\Factory\HtmlDomFactory;

$factory = new HtmlDomFactory();
$parser = $factory->createHtmlDomParserFromHtml('<div id="test">Hello World</div>');

$element = $parser->getFirstElementWithId('test');
echo $element->textContent; // Outputs: Hello World
```

## API Documentation

### HtmlDomFactory

#### Methods

- **`createHtmlDomDocument(string $html): DOMDocument`**: Creates and returns a `DOMDocument` from the provided HTML string.
- **`createXPath(DOMDocument $document, bool $registerNodeNS = true): DOMXPath`**: Creates and returns a `DOMXPath` instance from the provided `DOMDocument`.
- **`createXPathFromHtml(string $html, bool $registerNodeNS = true): DOMXPath`**: Creates and returns a `DOMXPath` instance from the provided HTML string.
- **`createHtmlDomParserFromHtml(string $html): HtmlDomParser`**: Creates and returns a `HtmlDomParser` instance from the provided HTML string.

### HtmlDomParser

#### Methods

- **`getFirstElementWithId(string $id, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMElement`**: Retrieves the first element with the specified ID.
- **`getElementsWithClass(string $className, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMNodeList`**: Retrieves all elements with the specified class name.
- **`getFirstElementWithClass(string $className, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMElement`**: Retrieves the first element with the specified class name.
- **`getElementsWithTag(string $tag, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMNodeList`**: Retrieves all elements with the specified tag name.
- **`getFirstElementWithTag(string $tag, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMElement`**: Retrieves the first element with the specified tag name.
- **`xPathQuery(string $query, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMNodeList`**: Executes an XPath query on the DOM and returns the result.
- **`hasClass(string $class, DOMElement $element): bool`**: Checks if an element has a specific class.

## Testing

To run the tests, use the following command:

```bash
vendor/bin/phpunit
```

The tests are located in the `tests` directory and cover the functionality of the main components such as `HtmlDomFactory` and `HtmlDomParser`.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
