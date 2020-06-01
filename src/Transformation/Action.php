<?php
/**
 * This file is part of the Cloudinary PHP package.
 *
 * (c) Cloudinary
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cloudinary\Transformation;

/**
 * Class Action
 *
 * @api
 */
class Action extends BaseAction
{
    /**
     * Action named constructor.
     *
     * @param mixed ...$parameters
     *
     * @return BaseAction
     */
    public static function generic(...$parameters)
    {
        return new static(...$parameters);
    }
}