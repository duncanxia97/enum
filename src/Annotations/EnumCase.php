<?php
/**
 * @author XJ.
 * Date: 2022/10/6 0006
 */

namespace Fatbit\Enums\Annotations;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class EnumCase
{
    public function __construct(
        public readonly string          $desc,
        public readonly null|string|int $group = null,
        public readonly ?string         $name = null,
        public readonly ?array          $ext = null,
    )
    {
    }
}
