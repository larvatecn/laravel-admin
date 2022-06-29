<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method self api($v)
 * @method self ws($v)
 * @method self dataProvider($v)
 * @method self body($v)
 * @method self fetchOn($v)
 * @method self initFetch($v)
 * @method self initFetchOn($v)
 * @method self schemaApi($v)
 * @method self initFetchSchema($v)
 * @method self initFetchSchemaOn($v)
 * @method self interval($v)
 * @method self silentPolling($v)
 * @method self stopAutoRefreshWhen($v)
 * @method self messages($v)
 * @method self name($v)
 */
class Service extends BaseSchema
{
    public string $type = 'service';
}
