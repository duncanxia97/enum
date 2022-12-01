<?php
/**
 * @author XJ.
 * Date: 2022/12/1 0001
 */

namespace Fatbit\Enums\Annotations;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class ErrorCode
{
    public function __construct(
        public readonly ?string $desc = null
    )
    {
    }

}