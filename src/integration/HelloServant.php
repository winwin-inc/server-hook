<?php

declare(strict_types=1);

/**
 * NOTE: This class is auto generated by Tars Generator (https://github.com/wenbinye/tars-generator).
 *
 * Do not edit the class manually.
 * Tars Generator version: 1.0-SNAPSHOT
 */

namespace winwin\server\hook\integration;

use wenbinye\tars\protocol\annotation\TarsClient;
use wenbinye\tars\protocol\annotation\TarsReturnType;

/**
 * @TarsClient(name="HelloObj")
 */
interface HelloServant
{
    /**
     * @TarsReturnType(type = "void")
     *
     * @return void
     */
    public function hello();
}
