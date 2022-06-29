<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method self levelExpand($v)
 * @method self source($v)
 * @method self mutable($v)
 * @method self displayDataTypes($v)
 * @method self enableClipboard($v)
 * @method self iconStyle($v)
 * @method self quotesOnKeys($v)
 * @method self sortKeys($v)
 */
class Json extends BaseSchema
{
    public string $type = 'json';
}
