<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Plugin\AdminNotification\Block\Grid\Renderer;

use Magento\AdminNotification\Block\Grid\Renderer\Notice as NativeNotice;

class Notice
{
    public function aroundRender(
        NativeNotice $subject,
        \Closure $proceed,
        \Magento\Framework\DataObject $row
    ) {
        $result = $proceed($row);

        $magesquareLogo = '';
        $magesquareImage = '';
        if ($row->getData('is_magesquare')) {
            if ($row->getData('image_url')) {
                $magesquareImage = ' style="background: url(' . $row->getData("image_url") . ') no-repeat;"';
            } else {
                $magesquareLogo = ' magesquare-grid-logo';
            }
        }
        $result = '<div class="msbase-grid-message' . $magesquareLogo . '"' . $magesquareImage . '>' . $result . '</div>';

        return  $result;
    }
}
