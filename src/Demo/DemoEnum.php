<?php
/**
 * @author XJ.
 * Date: 2022/9/30 0030
 */

namespace Fatbit\Enums\Demo;

use Fatbit\Enums\Annotations\EnumCase;
use Fatbit\Enums\Interfaces\EnumCaseInterface;
use Fatbit\Enums\Traits\EnumCaseGet;

enum DemoEnum: int implements EnumCaseInterface
{
    use EnumCaseGet;

    #[EnumCase(desc: '系统错误', group: 'sys', ext: ['color' => 'red'])]
    case SYSTEM_ERROR = 500;

    #[EnumCase(desc: '不存在')]
    case NOT_FOUND = 404;
}
