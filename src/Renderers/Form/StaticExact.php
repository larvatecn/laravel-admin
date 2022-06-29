<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method $this tpl($v)
 * @method $this text($v)
 * @method $this popOver($v)
 * @method $this quickEdit($v)
 * @method $this copyable($v)
 * @method $this borderMode($v)
 */
class StaticExact extends FormBase
{
    public string $type = 'static';
}
