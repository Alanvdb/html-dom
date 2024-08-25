<?php declare(strict_types=1);

namespace AlanVdb\Html\Factory;

use AlanVdb\Html\Definition\HtmlDomFactoryInterface;
use AlanVdb\Html\HtmlDomParser;
use DOMDocument;
use DOMXPath;
use AlanVdb\Html\Exception\InvalidHtmlProvided;
use ValueError;

/**
 * Class HtmlDomFactory
 *
 * This class is responsible for creating and configuring DOMDocument and DOMXPath instances 
 * from provided HTML strings. It also provides methods to create HtmlDomParser instances 
 * from HTML strings.
 */
class HtmlDomFactory implements HtmlDomFactoryInterface
{
    /**
     * Creates and returns a DOMDocument from the provided HTML string.
     *
     * This method loads the HTML content into a new DOMDocument instance.
     *
     * @param string $html The HTML content to load into the DOMDocument.
     * @return DOMDocument The created DOMDocument instance.
     * @throws InvalidHtmlProvided If the HTML content cannot be parsed into a DOMDocument.
     */
    public function createHtmlDomDocument(string $html): DOMDocument
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);

        try {
            $dom->loadHTML($html);
        } catch (ValueError $e) {
            throw new InvalidHtmlProvided("Could not create DOMDocument from provided html : '$html'.", 0, $e);
        }

        libxml_clear_errors();
        return $dom;
    }

    /**
     * Creates and returns a DOMXPath instance from the provided DOMDocument.
     *
     * This method creates a new DOMXPath object associated with the given DOMDocument.
     *
     * @param DOMDocument $document The DOMDocument instance.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMXPath The created DOMXPath instance.
     */
    public function createXPath(DOMDocument $document, bool $registerNodeNS = true): DOMXPath
    {
        return new DOMXPath($document, $registerNodeNS);
    }

    /**
     * Creates and returns a DOMXPath instance from the provided HTML string.
     *
     * This method first creates a DOMDocument from the HTML string and then creates a DOMXPath 
     * object associated with it.
     *
     * @param string $html The HTML content to load into the DOMDocument.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMXPath The created DOMXPath instance.
     * @throws InvalidHtmlProvided If the HTML content cannot be parsed into a DOMDocument.
     */
    public function createXPathFromHtml(string $html, bool $registerNodeNS = true): DOMXPath
    {
        try {
            $dom = $this->createHtmlDomDocument($html);
        } catch (InvalidHtmlProvided $e) {
            throw new InvalidHtmlProvided("Could not create XPath from provided html : '$html'.", 0, $e->getPrevious());
        }
        return new DOMXPath($dom, $registerNodeNS);
    }

    /**
     * Creates and returns a HtmlDomParser instance from the provided HTML string.
     *
     * This method creates a DOMDocument and DOMXPath, and then uses them to instantiate 
     * a new HtmlDomParser.
     *
     * @param string $html The HTML content to load into the DOMDocument.
     * @return HtmlDomParser The created HtmlDomParser instance.
     * @throws InvalidHtmlProvided If the HTML content cannot be parsed into a DOMDocument.
     */
    public function createHtmlDomParserFromHtml(string $html) : HtmlDomParser
    {
        $domDocument = $this->createHtmlDomDocument($html);
        $xPath = $this->createXPath($domDocument);
        return new HtmlDomParser($xPath);
    }
}
