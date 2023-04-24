<?php
/**
 * @author XJ.
 * Date: 2022/10/8 0008
 */

namespace Fatbit\Enums\Interfaces;

/**
 * @property string $name
 */
interface EnumCaseInterface
{
    /**
     * 获取拓展
     *
     * @author XJ.
     * Date: 2022/10/7 0007
     *
     * @param $key
     *
     * @return array|mixed|null
     */
    public function ext($key = null);

    /**
     * 解释
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     * @return string|null
     */
    public function desc(): ?string;

    /**
     * 名称
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     * @return string|null
     */
    public function name(): ?string;

    /**
     * 获取分组数据
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     *
     * @param $groupName
     *
     * @return array|int|string
     */
    public static function group(string|int $groupName, string|int $name = null): array|static|null;

    /**
     * 将枚举转换为数组
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     * @return array
     */
    public function toArray(): array;


}