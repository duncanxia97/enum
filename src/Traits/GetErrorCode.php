<?php
/**
 * @author XJ.
 * Date: 2022/10/19 0019
 */

namespace Fatbit\Enums\Traits;

use Fatbit\Enums\Annotations\EnumCase;
use Fatbit\Enums\Annotations\ErrorCode;
use Fatbit\Enums\Annotations\ErrorCodePrefix;
use Fatbit\Enums\Interfaces\ErrorCodeInterface;
use ReflectionEnum;
use ReflectionEnumUnitCase;

/**
 * @implements ErrorCodeInterface
 */
trait GetErrorCode
{
    use GetEnumAttributes;

    /**
     * 获取枚举解释
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     *
     * @param int $get
     *
     * @return ErrorCodePrefix|null
     */
    protected function getErrorCodePrefix(int $get = 0): ?ErrorCodePrefix
    {
        return static::getEnumAttribute(ErrorCodePrefix::class, $get);
    }

    /**
     * 获取枚举解释
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     *
     * @param int $get
     *
     * @return EnumCase|null
     */
    protected function getErrorCode(int $get = 0): ?ErrorCode
    {
        return $this->getEnumCaseAttribute(ErrorCode::class, $get);
    }

    /**
     * 获取错误信息
     *
     * @author XJ.
     * Date: 2022/10/19 0019
     * @return string
     */
    public function getErrorMsg(): string
    {
        return $this->getErrorCode()?->desc ?? '';
    }

    /**
     * 获取错误码
     *
     * @author XJ.
     * Date: 2022/10/28 0028
     * @return int
     */
    public function getCode(): int
    {
        $code   = $this->value;
        $prefix = $this->getErrorCodePrefix()?->prefix;
        if ($prefix === null) {
            return $code;
        }

        return (int)((string)($prefix) . (string)($code));
    }

    /**
     * 获取错误码前缀注释
     *
     * @author XJ.
     * Date: 2022/12/1 0001
     * @return string|null
     */
    public function getPrefixDesc(): ?string
    {
        return $this->getErrorCodePrefix()?->desc;
    }


    /**
     * 获取错误码前缀
     *
     * @author XJ.
     * Date: 2022/12/1 0001
     * @return int|null
     */
    public function getPrefixCode(): ?int
    {
        return $this->getErrorCodePrefix()?->prefix;
    }

    /**
     * 通过错误码获取错误枚举
     *
     * @author XJ.
     * @Date   2024/2/26 0026
     *
     * @param int $code
     *
     * @return $this
     */
    public static function fromByCode(int $code): static
    {
        return static::from(static::getRealCode($code));
    }

    /**
     * 通过错误码获取错误枚举
     *
     * @author XJ.
     * @Date   2024/2/26 0026
     *
     * @param int $code
     *
     * @return $this
     */
    public static function tryFromByCode(int $code): ?static
    {
        return static::tryFrom(static::getRealCode($code));
    }

    /**
     * 获取真实错误码
     *
     * @author XJ.
     * @Date   2024/2/26 0026
     *
     * @param int $code
     *
     * @return int
     */
    public static function getRealCode(int $code): int
    {
        $code = (string)$code;
        $prefixCode = (string)(static::getEnumAttribute(ErrorCodePrefix::class)?->prefix ?? '');
        $position = strpos($code, $prefixCode);
        if ($position === false){
            return (int)$code;
        }
        return (int)substr($code, $position + strlen($prefixCode));
    }

}