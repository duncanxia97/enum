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

trait EnumCaseGet
{

    /**
     * 获取枚举解释
     *
     * @author XJ.
     * Date: 2022/10/6 0006
     *
     * @param $get
     *
     * @return EnumCase|null
     */
    protected function getEnumCase($get = 0): ?EnumCase
    {
        return (new ReflectionEnumUnitCase($this, $this->name))
                   ->getAttributes(EnumCase::class)[$get]
                   ?->newInstance() ?? null;
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
        $name = strtolower($name);
        $pos  = strpos($name, 'get');
        if ($pos === 0) {
            $getKey = substr($name, 3);

            return $this->ext($getKey);
        }

        return parent::__call($name, $arguments);
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
            'value' => $this->value,
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
    protected static function loadGroups(object $enum): array
    {
        $enum = new ReflectionEnum($enum);
        if (EnumGroups::issetGroups($enum->getName())) {
            return EnumGroups::getGroups($enum->getName());
        }
        $enumCases = $enum->getCases();
        foreach ($enumCases as $enumCase) {
            /** @var self $case */
            $case = $enumCase->getValue();
            EnumGroups::setGroups($enum->getName(), $case->getEnumCase()?->group, $case->name(), $case->getCaseData());
        }

        return EnumGroups::getGroups($enum->getName());
    }

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
    public function group(string|int $groupName, string|int $name = null): array|int|string|null
    {
        $groups = self::loadGroups($this);
        if ($name !== null) {
            return $this->group($groupName)[$name] ?? null;
        }

        return $groups[$groupName] ?? null;
    }
}