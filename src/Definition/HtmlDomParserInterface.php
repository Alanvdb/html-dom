<?php declare(strict_types=1);

namespace AlanVdb\Html\Definition;

use DOMDocument;
use DOMXPath;
use DOMElement;
use DOMNodeList;
use DOMNode;
use Exception;

interface HtmlDomParserInterface
{
    /**
     * Retrieves an element by its ID.
     *
     * @param string $id The ID of the element to retrieve.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMElement|null The element with the specified ID, or null if not found.
     */
    public function getFirstElementWithId(string $id, ?DOMNode $contextNode = null, bool $registerNodeNS = true) : ?DOMElement;

    /**
     * Retrieves all elements with the specified class name.
     *
     * @param string $className The class name of the elements to retrieve.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMNodeList|null A DOMNodeList of elements with the specified class name, or null if none found.
     */
    public function getElementsWithClass(string $className, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMNodeList;

    /**
     * Retrieves the first element with the specified class name.
     *
     * @param string $className The class name of the element to retrieve.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMElement|null The first element with the specified class name, or null if not found.
     */
    public function getFirstElementWithClass(string $className, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMElement;

    /**
     * Retrieves all elements with the specified tag name.
     *
     * @param string $tag The tag name of the elements to retrieve.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMNodeList|null A DOMNodeList of elements with the specified tag name, or null if none found.
     */
    public function getElementsWithTag(string $tag, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMNodeList;

    /**
     * Retrieves the first element with the specified tag name.
     *
     * @param string $tag The tag name of the element to retrieve.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMElement|null The first element with the specified tag name, or null if not found.
     */
    public function getFirstElementWithTag(string $tag, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMElement;

    /**
     * Executes an XPath query.
     *
     * @param string $query The XPath query string.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMNodeList|null A DOMNodeList containing the results of the query, or null if none found.
     */
    public function xPathQuery(string $query, ?DOMNode $contextNode = null, bool $registerNodeNS = true) : ?DOMNodeList;

    /**
     * Checks if an element has a specific class.
     *
     * Determines whether the provided element has the specified class in its class attribute.
     *
     * @param string $class The class name to check for.
     * @param DOMElement $element The DOMElement to check.
     * @return bool True if the element has the specified class, false otherwise.
     */
    public function hasClass(string $class, DOMElement $element) : bool;
}
