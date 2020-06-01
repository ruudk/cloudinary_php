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

use Cloudinary\ClassUtils;
use Cloudinary\Transformation\Argument\ColorValue;

/**
 * Class BorderValue
 */
class BorderValue extends ParameterMultiValue
{
    const VALUE_DELIMITER = '_';

    /**
     * @var array $argumentOrder The order of the arguments.
     */
    protected $argumentOrder = ['width', 'style', 'color'];

    /**
     * BorderValue constructor.
     *
     * @param null $color
     * @param null $width
     * @param null $style
     */
    public function __construct($color = null, $width = null, $style = null)
    {
        parent::__construct();

        $this->width($width);
        $this->style($style);
        $this->setValue(ClassUtils::verifyInstance($color, ColorValue::class));
    }

    /**
     * Sets the style of the border.
     *
     * @param string $style The border style.  Currently only "solid" is supported.
     *
     * @return $this
     */
    public function style($style)
    {
        return $this->setSimpleValue('style', $style);
    }

    /**
     * Sets the width of the border.
     *
     * @param int $width The width of the border in pixels.
     *
     * @return $this
     */
    public function width($width)
    {
        return $this->setSimpleValue('width', $width ? "{$width}px" : $width);
    }
}