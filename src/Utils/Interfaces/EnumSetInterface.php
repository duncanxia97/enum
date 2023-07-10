<?php
/**
 * @author XJ.
 * Date: 2023/7/10 0010
 */

namespace Fatbit\Enums\Utils\Interfaces;

interface EnumSetInterface
{
    /**
     *
     * @author XJ.
     * Date: 2023/7/10 0010
     *
     * @param string     $class
     * @param string|int $name
     * @param            $value
     *
     * @return bool
     */
    public static function set(string $class, string|int $name, $value): bool;

    /**
     *
     * @author XJ.
     * Date: 2023/7/10 0010
     *
     * @param string          $class
     * @param string|int|null $name
     *
     * @return bool
     */
    public static function isset(string $class, string|int|null $name = null): bool;

    /**
     *
     * @author XJ.
     * Date: 2023/7/10 0010
     *
     * @param string          $class
     * @param string|int|null $name
     *
     * @return mixed
     */
    public static function get(string $class, string|int|null $name = null): mixed;
}