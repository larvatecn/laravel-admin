<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * 文本输入框
 *
 * @method $this addOn($v)
 * @method $this trimContents($v)
 * @method $this autoComplete($v)
 * @method $this borderMode($v)
 * @method $this maxLength($v)
 * @method $this showCounter($v)
 * @method $this prefix($v)
 * @method $this suffix($v)
 * @method $this transform($v)
 */
class InputText extends FormOptions
{
    public string $type = 'input-text';

    /**
     * 邮件输入框
     *
     * @return $this
     */
    public function email(): InputText
    {
        $this->type = 'input-email';
        return $this;
    }

    public function url(): InputText
    {
        $this->type = 'input-url';
        return $this;
    }

    public function password(): InputText
    {
        $this->type = 'input-password';
        return $this;
    }

    public function date(): InputText
    {
        $this->type = 'native-date';
        return $this;
    }

    public function time(): InputText
    {
        $this->type = 'native-time';
        return $this;
    }

    public function number(): InputText
    {
        $this->type = 'native-number';
        return $this;
    }
}
