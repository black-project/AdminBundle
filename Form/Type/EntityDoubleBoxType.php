<?php

namespace Black\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * DoubleBoxType
 */
class EntityDoubleBoxType extends AbstractType
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'entity';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'entity_double_box';
    }
}