<?php
/**
 * @author XJ.
 * Date: 2022/10/6 0006
 */

namespace Fatbit\Enums\Traits;

use Fatbit\Enums\Annotations\EnumCase;
use Fatbit\Enums\Utils\EnumGroups;
use ReflectionEnum;
use ReflectionEnumUnitCase;

/**
 * @mixin \BackedEnum
 */
trait EnumCaseGet
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
     * @return EnumCase|null
     */
    protected function getEnumCase(int $get = 0): ?EnumCase
    {
        return $this->getEnumCaseAttribute(EnumCase::class, $get);
    }

    /**
     * @author XJ.
     * Date: 2022/10/7 0007
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return array|mixed|void|null
     */
    public function __call(string $name, array $arguments)
    {
        $ext = $this->ext();
        $pos = stripos($name, 'get');
        if ($pos === 0) {
            $getKey = substr($name, 3);

            if (isset($ext[$getKey])) {
                return $ext[$getKey];
            }
        }
        if (isset($ext[$name])) {
            return $ext[$name];
        }

        return null;
    }

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
    public function ext($key = null)
    {
        if (!empty($key)) {
            return $this->getEnumCase()->ext[$key] ?? null;
        }

        return $this->getEnumCase()->ext;
    }


    /**
     * 将枚举转换为数组
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name'  => $this->name(),
            'value' => $this->value ?? null,
            'desc'  => $this->desc(),
            'group' => $this->getEnumCase()->group,
            'ext'   => $this->ext(),
        ];
    }

    /**
     * 解释
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     * @return string|null
     */
    public function desc(): ?string
    {
        return $this->getEnumCase()?->desc;
    }

    /**
     * 名称
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->getEnumCase()?->name ?? $this->name;
    }

    /**
     * 加载分组数据
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     *
     * @param object $enum
     *
     * @return array
     * @throws \ReflectionException
     */
    protected static function loadGroups(): array
    {
        $class = static::class;
        if (EnumGroups::issetGroups($class)) {
            return EnumGroups::getGroups($class);
        }
        foreach (static::cases() as $case) {
            /** @var self $case */
            EnumGroups::setGroups($class, $case->getEnumCase()?->group, $case->name(), $case);
        }

        return EnumGroups::getGroups($class);
    }

    /**
     * 获取分组数据
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     *
     * @param string|int      $groupName
     * @param string|int|null $name
     *
     * @return array|static|static[]|null
     * @throws \ReflectionException
     */
    public static function group(string|int $groupName, string|int $name = null): array|static|null
    {
        $groups = static::loadGroups();
        if ($name !== null) {
            return static::group($groupName)[$name] ?? null;
        }

        return $groups[$groupName] ?? null;
    }

    /**
     * 通过字段获取枚举
     * @author XJ.
     * @Date   2024/12/3 星期二
     *
     * @param string      $field     字段名
     * @param string|null $groupName 分组名(如果设置了分组)
     *
     * @return array|static[]
     */
    public static function keyBy(string $field, ?string $groupName = null): array
    {
        $result = [];
        $getKey = function (self $case, $field) {
            $data = $case->toArray();
            if (isset($data[$field])) {
                return $data[$field];
            }
            if (isset($data['ext'][$field])) {
                return $data['ext'][$field];
            }

            return null;
        };
        if (!is_null($groupName)) {
            $group = static::group($groupName) ?: [];
            foreach ($group as $case) {
                $key = $getKey($case, $field);
                if (!is_null($key)) {
                    $result[$key] = $case;
                }
            }

            return $result;
        }
        foreach (static::cases() as $case) {
            $key = $getKey($case, $field);
            if (!is_null($key)) {
                $result[$key] = $case;
            }
        }

        return $result;
    }

    /**
     * 通过值获取枚举
     * @author XJ.
     * @Date   2024/12/3 星期二
     *
     * @param             $value
     * @param string|null $field
     * @param string|null $groupName
     *
     * @return static|null
     */
    public static function fromBy($value, ?string $field = null, ?string $groupName = null): ?static
    {
        if (is_null($field) && is_null($groupName)) {
            if (static::class instanceof \BackedEnum) {
                return static::tryFrom($value);
            }

            return null;
        }
        $cases = self::keyBy($field, $groupName);

        return $cases[$value] ?? null;
    }
}