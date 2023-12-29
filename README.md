### 下载安装
~~~bash
composer require fatbit/enums
~~~

### 一. 常规枚举

> 使用方法和php enum官方一样,你只需要引用"EnumCaseGet"和实现"EnumCaseInterface"即可
> 
> ps: 详细参照 "\Fatbit\Enums\Demo\DemoEnum"
> 
~~~php
use Fatbit\Enums\Annotations\EnumCase;
use Fatbit\Enums\Interfaces\EnumCaseInterface;
use Fatbit\Enums\Traits\EnumCaseGet;

enum DemoEnum: int implements EnumCaseInterface
{
    use EnumCaseGet;

    #[EnumCase(desc: '系统错误', name:'SYS_ERR', group: 'sys', ext: ['color' => 'red'])]
    case SYSTEM_ERROR = 500;
    
    #[EnumCase(desc: '系统错误2', group: 'sys', ext: ['color' => 'red'])]
    case SYSTEM_ERROR2 = 501;

    #[EnumCase(desc: '不存在')]
    case NOT_FOUND = 404;
}
~~~

#### 1. 枚举函数

> 获取枚举注释
> 
~~~php

// 获取枚举注释
\Fatbit\Enums\Demo\DemoEnum::SYSTEM_ERROR->desc(); // 系统错误

~~~

> 获取枚举拓展数据
>
~~~php

// 获取枚举拓展数据
\Fatbit\Enums\Demo\DemoEnum::SYSTEM_ERROR->ext(); // 改数据是上面拓展中的数据: ['color' => 'red']

~~~

> 获取枚举拓展数据的某个值
>
~~~php

// 获取枚举拓展数据的某个值
\Fatbit\Enums\Demo\DemoEnum::SYSTEM_ERROR->ext('color'); // red
// 或者
\Fatbit\Enums\Demo\DemoEnum::SYSTEM_ERROR->color(); // red

~~~

> 获取枚举分组
> 
> 获取到的数据是以枚举名称为键的数组 值为该枚举对象(也代表他支持枚举原有特性), 当然转换成json也就是他的枚举值
>
~~~php

// 获取枚举分组 获取到的数据是以枚举名称为键的数组 值为该枚举对象, 当然转换成json也就是他的枚举值

\Fatbit\Enums\Demo\DemoEnum::group('sys'); // ['SYSTEM_ERROR' => \Fatbit\Enums\Demo\DemoEnum::SYSTEM_ERROR,'SYSTEM_ERROR2' => \Fatbit\Enums\Demo\DemoEnum::SYSTEM_ERROR2]
\Fatbit\Enums\Demo\DemoEnum::group('sys')['SYSTEM_ERROR']->desc() // 系统错误

~~~

> 获取枚举别名
>
~~~php

// 获取枚举别名
\Fatbit\Enums\Demo\DemoEnum::SYSTEM_ERROR->name(); // SYS_ERR

~~~

> 将枚举转换为数组
> 

~~~php

// 将枚举转换为数组
\Fatbit\Enums\Demo\DemoEnum::SYSTEM_ERROR->toArray(); 

~~~

### 一. 错误码

> 使用方法
> "ErrorCodePrefix" 定义错误码前缀, 定义错误码前缀和前缀注释
> "ErrorCode" 定义错误码注释
> 
> ps: 详细参照 "\Fatbit\Enums\Demo\DemoEnum"
>

~~~php

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
~~~

#### 1. 错误码函数

> 获取错误码
> 
~~~php

// 获取错误码
\Fatbit\Enums\Demo\DemoErrorCode::SYSTEM_ERROR->getCode(); // 10500

~~~

> 获取错误码注释
>
~~~php

// 获取错误码注释
\Fatbit\Enums\Demo\DemoErrorCode::SYSTEM_ERROR->getErrorMsg(); // 系统错误

~~~

> 获取错误码前缀
>
~~~php

// 获取错误码前缀
\Fatbit\Enums\Demo\DemoErrorCode::SYSTEM_ERROR->getPrefixCode(); // 10

~~~


> 获取错误码前缀注释
>
~~~php

// 获取错误码前缀注释
\Fatbit\Enums\Demo\DemoErrorCode::SYSTEM_ERROR->getPrefixDesc(); // 系统错误码

~~~

二. 获取枚举注解

>
> 使用 **GetEnumAttributes** 引用trait
> 能够快速提取枚举注解对象
>

~~~php

use Fatbit\Enums\Annotations\ErrorCode;
use Fatbit\Enums\Annotations\ErrorCodePrefix;

// 获取枚举对象注解 返回是一个数组
/** @var ErrorCodePrefix[]|array $res */
$res = \Fatbit\Enums\Demo\DemoErrorCode::SYSTEM_ERROR->getEnumAttributes(ErrorCodePrefix::class);
// 获取枚举对象注解 返回是一个对象
/** @var ErrorCodePrefix|null $res */
$res = \Fatbit\Enums\Demo\DemoErrorCode::SYSTEM_ERROR->getEnumAttribute(ErrorCodePrefix::class);

// 获取枚举注解 返回是一个数组
/** @var ErrorCode[]|array $res */
$res = \Fatbit\Enums\Demo\DemoErrorCode::SYSTEM_ERROR->getEnumCaseAttributes(ErrorCode::class);
// 获取枚举注解 返回是一个对象
/** @var ErrorCode|null $res */
$res = \Fatbit\Enums\Demo\DemoErrorCode::SYSTEM_ERROR->getEnumCaseAttribute(ErrorCode::class);




~~~

## 鸣谢

 <img src="https://resources.jetbrains.com/storage/products/company/brand/logos/jb_beam.svg" width = "200" height = "218.6" alt="图片名称" align=center />

- 感谢 `JetBrains` 提供的IDE支持！
- 相关: [JetBrains网站](https://www.jetbrains.com/?from=apiDoc)