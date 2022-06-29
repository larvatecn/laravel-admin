<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this language($v)
 * @method $this editorTheme($v)
 * @method $this tabSize($v)
 * @method $this wordWrap($v)
 * @method $this customLang($v)
 */
class Code extends BaseSchema
{
    public string $type = 'code';
}
