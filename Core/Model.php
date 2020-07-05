<?php

declare(strict_types=1);

namespace Core;

/**
 * Class Model
 * @package Core
 */
abstract class Model
{
    protected ?Database $DB = null;

    public function __construct()
    {
        $this->DB = Database::instance();
    }
}
