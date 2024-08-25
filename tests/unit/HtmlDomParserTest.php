<?php declare(strict_types=1);

namespace AlanVdb\Tests\Html;

use AlanVdb\Html\HtmlDomParser;
use PHPUnit\Framework\TestCase;
use DOMDocument;
use DOMXPath;
use DOMElement;
use DOMNode;
use DOMNodeList;
use Exception;

#[CoversClass(HtmlDomParser::class)]
class HtmlDomParserTest extends TestCase
{
    protected DOMXPath $xpath;
    protected HtmlDomParser $parser;

    protected function setUp(): void
    {
        $dom = new DOMDocument();
        $html = '<div id="testId" class="testClass"></div>';
        $dom->loadHTML($html);
        $this->xpath = new DOMXPath($dom);
        $this->parser = new HtmlDomParser($this->xpath);
    }

    #[\PHPUnit\Test]
    public function testGetFirstElementWithIdReturnsElement()
    {
        $element = $this->parser->getFirstElementWithId('testId');
        $this->assertInstanceOf(DOMElement::class, $element);
        $this->assertSame('testId', $element->getAttribute('id'));
    }

    #[\PHPUnit\Test]
    public function testGetFirstElementWithIdReturnsNullWhenNotFound()
    {
        $element = $this->parser->getFirstElementWithId('nonExistentId');
        $this->assertNull($element);
    }

    #[\PHPUnit\Test]
    public function testGetElementsWithClassReturnsNodeList()
    {
        $nodeList = $this->parser->getElementsWithClass('testClass');
        $this->assertInstanceOf(DOMNodeList::class, $nodeList);
        $this->assertCount(1, $nodeList);
    }

    #[\PHPUnit\Test]
    public function testGetElementsWithClassReturnsNullWhenNotFound()
    {
        $nodeList = $this->parser->getElementsWithClass('nonExistentClass');
        $this->assertNull($nodeList);
    }

    #[\PHPUnit\Test]
    public function testGetFirstElementWithClassReturnsElement()
    {
        $element = $this->parser->getFirstElementWithClass('testClass');
        $this->assertInstanceOf(DOMElement::class, $element);
        $this->assertSame('testClass', $element->getAttribute('class'));
    }

    #[\PHPUnit\Test]
    public function testGetFirstElementWithClassReturnsNullWhenNotFound()
    {
        $element = $this->parser->getFirstElementWithClass('nonExistentClass');
        $this->assertNull($element);
    }

    #[\PHPUnit\Test]
    public function testGetElementsWithTagReturnsNodeList()
    {
        $nodeList = $this->parser->getElementsWithTag('div');
        $this->assertInstanceOf(DOMNodeList::class, $nodeList);
        $this->assertCount(1, $nodeList);
    }

    #[\PHPUnit\Test]
    public function testGetElementsWithTagReturnsNullWhenNotFound()
    {
        $nodeList = $this->parser->getElementsWithTag('span');
        $this->assertNull($nodeList);
    }

    #[\PHPUnit\Test]
    public function testGetFirstElementWithTagReturnsElement()
    {
        $element = $this->parser->getFirstElementWithTag('div');
        $this->assertInstanceOf(DOMElement::class, $element);
    }

    #[\PHPUnit\Test]
    public function testGetFirstElementWithTagReturnsNullWhenNotFound()
    {
        $element = $this->parser->getFirstElementWithTag('span');
        $this->assertNull($element);
    }

    #[\PHPUnit\Test]
    public function testXPathQueryReturnsNodeList()
    {
        $nodeList = $this->parser->xPathQuery('//div');
        $this->assertInstanceOf(DOMNodeList::class, $nodeList);
        $this->assertCount(1, $nodeList);
    }

    #[\PHPUnit\Test]
    public function testXPathQueryReturnsNullWhenNotFound()
    {
        $nodeList = $this->parser->xPathQuery('//span');
        $this->assertNull($nodeList);
    }

    #[\PHPUnit\Test]
    public function testHasClassReturnsTrue()
    {
        $element = $this->parser->getFirstElementWithId('testId');
        $this->assertTrue($this->parser->hasClass('testClass', $element));
    }

    #[\PHPUnit\Test]
    public function testHasClassReturnsFalse()
    {
        $element = $this->parser->getFirstElementWithId('testId');
        $this->assertFalse($this->parser->hasClass('nonExistentClass', $element));
    }
}
