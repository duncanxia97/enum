<?php
/**
 * @author XJ.
 * @Date   2023/9/20 0020
 */

namespace Fatbit\Enums\Traits;

use ReflectionEnum;
use ReflectionEnumUnitCase;

trait GetEnumAttributes
{

    /**
     * @author XJ.
     * @Date   2023/9/20 0020
     * @template T
     *
     * @param string|class-string<T> $attribute
     *
     * @return array|T[]
     * @throws \ReflectionException
     */
    public static function getEnumAttributes(string $attribute): array
    {
        return array_map(
            fn($reflectionAttribute) => $reflectionAttribute->newInstance(),
            (new ReflectionEnum(static::class))
                ->getAttributes($attribute)
        );
    }

    /**
     * @author XJ.
     * @Date   2023/9/20 0020
     * @template T
     *
     * @param string|class-string<T> $attribute
     *
     * @return object|null|T
     */
    public static function getEnumAttribute(string $attribute, int $get = 0): ?object
    {
        return ((new ReflectionEnum(static::class))
                    ->getAttributes($attribute)[$get] ?? null)
            ?->newInstance();
    }

    /**
     *
     * @author XJ.
     * @Date   2023/9/20 0020
     * @template T
     *
     * @param string|class-string<T> $attribute
     *
     * @return array|T[]
     */
    public function getEnumCaseAttributes(string $attribute): array
    {
        return array_map(
            fn($reflectionAttribute) => $reflectionAttribute->newInstance(),
            (new ReflectionEnumUnitCase($this, $this->name))
                ->getAttributes($attribute)
        );
    }

    /**
     * @author XJ.
     * @Date   2023/9/20 0020
     * @template T
     *
     * @param string|class-string<T> $attribute
     *
     * @return object|null|T
     */
    public function getEnumCaseAttribute(string $attribute, int $get = 0): ?object
    {
        return ((new ReflectionEnumUnitCase($this, $this->name))
                    ->getAttributes($attribute)[$get] ?? null)
            ?->newInstance();
    }
}