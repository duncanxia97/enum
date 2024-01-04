<?php
/**
 * @author XJ.
 * @Date   2024/1/4 0004
 */

namespace Fatbit\Enums\Demo;

use Fatbit\Enums\Annotations\EnumCase;
use Fatbit\Enums\Annotations\ErrorCode;
use Fatbit\Enums\Annotations\ErrorCodePrefix;
use Fatbit\Enums\Traits\GetEnumAttributes;

#[ErrorCodePrefix(100, '系统错误码')]
enum EnumAttributes
{
    use GetEnumAttributes;

    #[EnumCase('test')]
    #[ErrorCode('测试错误')]
    case TEST_CASE;
}
