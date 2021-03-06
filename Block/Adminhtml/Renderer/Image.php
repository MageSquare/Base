<?php
/**
 * MageSquare
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the magesquare.com license that is
 * available through the world-wide-web at this URL:
 * 
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    MageSquare
 * @package     MageSquare_Base
 * @copyright   Copyright (c) 2021 MageSquare 
 *      
 */

namespace MageSquare\Base\Block\Adminhtml\Renderer;

/**
 * Renderer image for admin form
 * Add media path to url
 *
 * Class Image
 * @package MageSquare\Base\Block\Adminhtml\Renderer
 */
class Image extends \Magento\Framework\Data\Form\Element\Image
{
    /**
     * Get image preview url
     *
     * @return string
     */
    protected function _getUrl()
    {
        $url = parent::_getUrl();

        if ($this->getPath()) {
            $url = $this->getPath() . '/' . trim($url, '/');
        }

        return $url;
    }
}
