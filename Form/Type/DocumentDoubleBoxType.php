<?php

/*
 * This file is part of the Black package.
 *
 * (c) Boris Tacyniak <boris.tacyniak@free.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

/**
 * DoubleBoxType
 *
 * @package Black\Bundle\AdminBundle
 * @author  Boris Tacyniak <boris.tacyniak@free.fr>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class DocumentDoubleBoxType extends AbstractType
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'document';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'document_double_box';
    }
}
