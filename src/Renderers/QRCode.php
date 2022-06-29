<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this name($v)
 * @method $this qrcodeClassName($v)
 * @method $this codeSize($v)
 * @method $this backgroundColor($v)
 * @method $this foregroundColor($v)
 * @method $this level($v)
 * @method $this placeholder($v)
 */
class QRCode extends BaseSchema
{
    public string $type = 'qrcode';
}
