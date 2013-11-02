<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <albalmes@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Black\Bundle\CommonBundle\Form\Type\CustomChoiceListType;

/**
 * Class CustomDoubleBoxType
 *
 * @package Black\Bundle\AdminBundle\Form\Type
 * @author  Boris Tacyniak <boris.tacyniak@free.fr>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class CustomDoubleBoxType extends CustomChoiceListType
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'double_box';
    }
}
