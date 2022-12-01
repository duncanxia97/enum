<?php
/**
 * @author XJ.
 * Date: 2022/10/28 0028
 */

namespace Fatbit\Enums\Annotations;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class ErrorCodePrefix
{

    public function __construct(
        public readonly int    $prefix,
        public readonly ?string $desc = null
    )
    {
    }

}