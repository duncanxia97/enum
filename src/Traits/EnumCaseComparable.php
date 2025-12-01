<?php
/**
 * @author XJ.
 * @Date   2024/2/5 0005
 */

namespace Fatbit\Enums\Traits;

use BackedEnum;
use UnitEnum;

/**
 * @mixin  BackedEnum
 */
trait EnumCaseComparable
{

    /**
     * 解析值
     *
     * @author XJ.
     * @Date   2025/12/1
     *
     * @param int|string|EnumCaseComparable|UnitEnum $other
     *
     * @return int|string|UnitEnum
     */
    private function resolveValue(int|string|self|null $other = null): int|string|self|UnitEnum
    {
        if (is_null($other)) {
            return $this->resolveValue($this);
        }
        if (is_string($other) || is_int($other)) {
            return $other;
        }
        if ($other instanceof self && $this instanceof BackedEnum) {
            return $other->value;
        }
        if ($this instanceof UnitEnum) {
            return $other;
        }

        return $other;
    }

    /**
     * 等于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function is(int|string|self $other): bool
    {
        return $this->resolveValue() === $this->resolveValue($other);
    }

    /**
     * 不等于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function isNot(int|string|self $other): bool
    {
        return !$this->is($other);
    }


    /**
     * 大于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function greaterThan(int|string|self $other): bool
    {
        return $this->resolveValue() > $this->resolveValue($other);
    }

    /**
     * 大于或等于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function greaterThanOrEqual(int|string|self $other): bool
    {
        return $this->resolveValue() >= $this->resolveValue($other);
    }


    /**
     * 大于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function lessThan(int|string|self $other): bool
    {
        return $this->resolveValue() < $this->resolveValue($other);
    }


    /**
     * 小于或等于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function lessThanOrEqual(int|string|self $other): bool
    {
        return $this->resolveValue() <= $this->resolveValue($other);
    }

    /**
     * 范围内
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $min
     * @param int|string|self $max
     *
     * @return bool
     */
    public function between(int|string|self $min, int|string|self $max): bool
    {
        $value = $this->resolveValue();

        return $value >= $this->resolveValue($min) && $value <= $this->resolveValue($max);
    }


    /**
     * 等于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function eq(int|string|self $other): bool
    {
        return $this->is($other);
    }


    /**
     * 不等于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function neq(int|string|self $other): bool
    {
        return $this->isNot($other);
    }


    /**
     * 大于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function gt(int|string|self $other): bool
    {
        return $this->greaterThan($other);
    }


    /**
     * 大于或等于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function gte(int|string|self $other): bool
    {
        return $this->greaterThanOrEqual($other);
    }

    /**
     * 小于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function lt(int|string|self $other): bool
    {
        return $this->lessThan($other);
    }

    /**
     * 小于或等于
     *
     * @author XJ.
     * @Date   2025/10/29
     *
     * @param int|string|self $other
     *
     * @return bool
     */
    public function lte(int|string|self $other): bool
    {
        return $this->lessThanOrEqual($other);
    }
}

