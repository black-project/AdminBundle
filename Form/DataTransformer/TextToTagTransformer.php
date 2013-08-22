<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <albalmes@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Bundle\AdminBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;


/**
 * Class textToTagTransformer
 *
 * @author  Alexandre Balmes <albalmes@gmail.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class TextToTagTransformer implements DataTransformerInterface
{
    /**
     * @param mixed $keywords
     *
     * @return mixed|void
     */
    public function transform($keywords)
    {
        if (null === $keywords) {
            return;
        }

        $keywords = implode(',', $keywords);

        return $keywords;
    }

    /**
     * @param mixed $keywords
     *
     * @return mixed|void
     */
    public function reverseTransform($keywords)
    {
        if (!$keywords) {
            return array();
        }

        $keywords = explode(',', $keywords);

        return $keywords;
    }
}
