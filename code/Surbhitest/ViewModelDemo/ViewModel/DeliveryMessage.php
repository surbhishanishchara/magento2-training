<?php
//declare(strict_type=1);

namespace Surbhitest\ViewModelDemo\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class DeliveryMessage implements ArgumentInterface
{
    public function getMessage() :string
    {
        return "This message is from View Model";
    }
}
 