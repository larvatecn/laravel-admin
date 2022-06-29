<?php

declare(strict_types=1);
/**
 * This is NOT a freeware, use is subject to license terms
 */

namespace Larva\Admin\Traits;

use DateTimeInterface;

/**
 * 默认日期格式
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
trait HasDateTimeFormatter
{
    /**
     * 为数组 / JSON 序列化准备日期。
     *
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format($this->getDateFormat());
    }
}