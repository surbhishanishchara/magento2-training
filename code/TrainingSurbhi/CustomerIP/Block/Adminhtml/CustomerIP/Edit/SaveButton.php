<?php

namespace TrainingSurbhi\CustomerIP\Block\Adminhtml\CustomerIP\Edit;

use Magento\Customer\Block\Adminhtml\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        $url = $this->getUrl('customerip/customerip/save');
        return [
            'label' => __('Save Rows'),
            'class' => 'save primary',
            'on_click' => "setLocation('". $url ."'')",
            'sort_order' => 90,
        ];
    }
}
