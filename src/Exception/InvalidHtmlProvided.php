<?php declare(strict_types=1);

namespace AlanVdb\Html\Exception;

use Throwable;
use InvalidArgumentException;

class InvalidHtmlProvided
    extends InvalidArgumentException
    implements Throwable
{}