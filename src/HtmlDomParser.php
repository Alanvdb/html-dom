<?php declare(strict_types=1);

namespace AlanVdb\Html;

use AlanVdb\Html\Definition\HtmlDomParserInterface;
use DOMDocument;
use DOMXPath;
use DOMElement;
use DOMNodeList;
use DOMNode;
use Exception;

/**
 * Class HtmlDomParser
 *
 * This class provides methods for querying and manipulating an HTML DOM using XPath.
 * It allows you to retrieve elements by ID, class name, or tag name, as well as execute custom XPath queries.
 */
class HtmlDomParser implements HtmlDomParserInterface
{
    protected DOMXPath $xpath;

    /**
     * Constructor.
     *
     * Initializes the HtmlDomParser with a DOMXPath instance.
     *
     * @param DOMXPath $xpath The DOMXPath instance used for querying the DOM.
     */
    public function __construct(DOMXPath $xpath)
    {
        $this->xpath = $xpath;
    }

    /**
     * Retrieves the first element with the specified ID.
     *
     * Executes an XPath query to find the first element in the DOM with the given ID.
     *
     * @param string $id The ID of the element to retrieve.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMElement|null The element with the specified ID, or null if not found.
     * @throws Exception If the XPath query fails.
     */
    public function getFirstElementWithId(string $id, ?DOMNode $contextNode = null, bool $registerNodeNS = true) : ?DOMElement
    {
        $nodeList = $this->xPathQuery(".//*[@id='{$id}']", $contextNode, $registerNodeNS);
        return ($nodeList === null) ? null : $nodeList->item(0);
    }

    /**
     * Retrieves all elements with the specified class name.
     *
     * Executes an XPath query to find all elements in the DOM with the given class name.
     *
     * @param string $className The class name of the elements to retrieve.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMNodeList|null A DOMNodeList of elements with the specified class name, or null if none found.
     * @throws Exception If the XPath query fails.
     */
    public function getElementsWithClass(string $className, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMNodeList
    {
        $request = "//*[contains(concat(' ', normalize-space(@class), ' '), ' $className ')]";
        return $this->xPathQuery($request, $contextNode, $registerNodeNS);
    }

    /**
     * Retrieves the first element with the specified class name.
     *
     * Executes an XPath query to find the first element in the DOM with the given class name.
     *
     * @param string $className The class name of the element to retrieve.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMElement|null The first element with the specified class name, or null if not found.
     * @throws Exception If the XPath query fails.
     */
    public function getFirstElementWithClass(string $className, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMElement
    {
        $nodeList = $this->getElementsWithClass($className, $contextNode, $registerNodeNS);
        return ($nodeList !== null) ? $nodeList->item(0) : null;
    }

    /**
     * Retrieves all elements with the specified tag name.
     *
     * Executes an XPath query to find all elements in the DOM with the given tag name.
     *
     * @param string $tag The tag name of the elements to retrieve.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMNodeList|null A DOMNodeList of elements with the specified tag name, or null if none found.
     * @throws Exception If the XPath query fails.
     */
    public function getElementsWithTag(string $tag, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMNodeList
    {
        $request = ".//{$tag}";
        return $this->xPathQuery($request, $contextNode, $registerNodeNS);
    }

    /**
     * Retrieves the first element with the specified tag name.
     *
     * Executes an XPath query to find the first element in the DOM with the given tag name.
     *
     * @param string $tag The tag name of the element to retrieve.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMElement|null The first element with the specified tag name, or null if not found.
     * @throws Exception If the XPath query fails.
     */
    public function getFirstElementWithTag(string $tag, ?DOMNode $contextNode = null, bool $registerNodeNS = true): ?DOMElement
    {
        $nodeList = $this->getElementsWithTag($tag, $contextNode, $registerNodeNS);
        return ($nodeList !== null) ? $nodeList->item(0) : null;
    }

    /**
     * Executes an XPath query.
     *
     * Runs a custom XPath query on the DOM and returns the result.
     *
     * @param string $query The XPath query string.
     * @param DOMNode|null $contextNode The context node for the XPath query. Defaults to null.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMNodeList|null A DOMNodeList containing the results of the query, or null if none found.
     * @throws Exception If the XPath query fails.
     */
    public function xPathQuery(string $query, ?DOMNode $contextNode = null, bool $registerNodeNS = true) : ?DOMNodeList
    {
        $nodeList = $this->xpath->query($query, $contextNode, $registerNodeNS);
        return ($nodeList === false || $nodeList->count() === 0) ? null : $nodeList;
    }

    /**
     * Checks if an element has a specific class.
     *
     * Determines whether the provided element has the specified class in its class attribute.
     *
     * @param string $class The class name to check for.
     * @param DOMElement $element The DOMElement to check.
     * @return bool True if the element has the specified class, false otherwise.
     */
    public function hasClass(string $class, DOMElement $element) : bool
    {
        return in_array($class, explode(' ', $element->getAttribute('class')));
    }
}
