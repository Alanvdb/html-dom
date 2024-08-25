<?php

namespace AlanVdb\Html\Definition;

use AlanVdb\Html\HtmlDomParser;
use DOMDocument;
use DOMXPath;

interface HtmlDomFactoryInterface
{
    /**
     * Creates and returns a DOMDocument from the provided HTML string.
     *
     * @param string $html The HTML content to load into the DOMDocument.
     * @return DOMDocument The created DOMDocument instance.
     */
    public function createHtmlDomDocument(string $html) : DOMDocument;

    /**
     * Creates and returns a DOMXPath instance from the provided DOMDocument.
     *
     * @param DOMDocument $document The DOMDocument instance.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMXPath The created DOMXPath instance.
     */
    public function createXPath(DOMDocument $document, bool $registerNodeNS = true): DOMXPath;

    /**
     * Creates and returns a DOMXPath instance from the provided HTML string.
     *
     * @param string $html The HTML content to load into the DOMDocument.
     * @param bool $registerNodeNS Whether to register the namespace of the context node. Defaults to true.
     * @return DOMXPath The created DOMXPath instance.
     */
    public function createXPathFromHtml(string $html, bool $registerNodeNS = true): DOMXPath;

    /**
     * Creates and returns a HtmlDomParser instance from the provided HTML string.
     *
     * @param string $html The HTML content to load into the DOMDocument.
     * @return HtmlDomParser The created HtmlDomParser instance.
     */
    public function createHtmlDomParserFromHtml(string $html): HtmlDomParser;
}
