<?php
/**
 * @author XJ.
 * Date: 2022/10/19 0019
 */

namespace Fatbit\Enums\Interfaces;


/**
 * @property string $name
 * @property int    $value
 * @extends \IntBackedEnum
 */
interface ErrorCodeInterface
{
    /**
     * 获取错误信息
     *
     * @author XJ.
     * Date: 2022/10/19 0019
     * @return string
     */
    public function getErrorMsg(): string;

    /**
     * 获取错误码
     *
     * @author XJ.
     * Date: 2022/10/28 0028
     * @return int
     */
    public function getCode(): int;

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
    public static function fromByCode(int $code): static;

    /**
     * 通过错误码获取错误枚举
     *
     * @author XJ.
     * @Date   2024/2/26 0026
     *
     * @param int $code
     *
     * @return static|null
     */
    public static function tryFromByCode(int $code): ?static;
}