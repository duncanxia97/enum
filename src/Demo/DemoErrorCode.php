<?php
/**
 * @author XJ.
 * Date: 2022/12/1 0001
 */

namespace Fatbit\Enums\Demo;

use Fatbit\Enums\Annotations\ErrorCode;
use Fatbit\Enums\Annotations\ErrorCodePrefix;
use Fatbit\Enums\Interfaces\ErrorCodeInterface;
use Fatbit\Enums\Traits\GetErrorCode;

#[ErrorCodePrefix(10, '系统错误码')]
enum DemoErrorCode: int implements ErrorCodeInterface
{
    use GetErrorCode;

    // 错误码: 10500, 错误信息: 系统错误
    #[ErrorCode('系统错误')]
    case SYSTEM_ERROR = 500;
}