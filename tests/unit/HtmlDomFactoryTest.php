<?php declare(strict_types=1);

namespace AlanVdb\Tests\Html\Factory;

use AlanVdb\Html\Factory\HtmlDomFactory;
use AlanVdb\Html\HtmlDomParser;
use AlanVdb\Html\Exception\InvalidHtmlProvided;
use DOMDocument;
use DOMXPath;
use PHPUnit\Framework\TestCase;
use ValueError;

#[CoversClass(HtmlDomFactory::class)]
class HtmlDomFactoryTest extends TestCase
{
    protected HtmlDomFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new HtmlDomFactory();
    }

    #[\PHPUnit\Test]
    public function testCreateHtmlDomDocumentReturnsDomDocument()
    {
        $html = '<div id="testId" class="testClass"></div>';
        $domDocument = $this->factory->createHtmlDomDocument($html);

        $this->assertInstanceOf(DOMDocument::class, $domDocument);
        $this->assertSame('testId', $domDocument->getElementById('testId')->getAttribute('id'));
    }

    #[\PHPUnit\Test]
    public function testCreateHtmlDomDocumentThrowsInvalidHtmlProvidedOnEmptyHtml()
    {
        $this->expectException(InvalidHtmlProvided::class);

        $emptyHtml = ''; // Empty string, which triggers a ValueError in DOMDocument
        $this->factory->createHtmlDomDocument($emptyHtml);
    }

    #[\PHPUnit\Test]
    public function testCreateXPathReturnsDomXPath()
    {
        $html = '<div id="testId" class="testClass"></div>';
        $domDocument = $this->factory->createHtmlDomDocument($html);
        $xPath = $this->factory->createXPath($domDocument);

        $this->assertInstanceOf(DOMXPath::class, $xPath);
    }

    #[\PHPUnit\Test]
    public function testCreateXPathFromHtmlReturnsDomXPath()
    {
        $html = '<div id="testId" class="testClass"></div>';
        $xPath = $this->factory->createXPathFromHtml($html);

        $this->assertInstanceOf(DOMXPath::class, $xPath);
    }

    #[\PHPUnit\Test]
    public function testCreateXPathFromHtmlThrowsInvalidHtmlProvidedOnEmptyHtml()
    {
        $this->expectException(InvalidHtmlProvided::class);

        $emptyHtml = ''; // Empty string, which triggers a ValueError in DOMDocument
        $this->factory->createXPathFromHtml($emptyHtml);
    }

    #[\PHPUnit\Test]
    public function testCreateHtmlDomParserFromHtmlReturnsHtmlDomParser()
    {
        $html = '<div id="testId" class="testClass"></div>';
        $parser = $this->factory->createHtmlDomParserFromHtml($html);

        $this->assertInstanceOf(HtmlDomParser::class, $parser);
    }

    #[\PHPUnit\Test]
    public function testCreateHtmlDomParserFromHtmlThrowsInvalidHtmlProvidedOnEmptyHtml()
    {
        $this->expectException(InvalidHtmlProvided::class);

        $emptyHtml = ''; // Empty string, which triggers a ValueError in DOMDocument
        $this->factory->createHtmlDomParserFromHtml($emptyHtml);
    }
}
