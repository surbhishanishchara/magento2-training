<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace TrainingSurbhi\Car\Model\Car\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class IsActive implements OptionSourceInterface
{
    /**
     * @var \TrainingSurbhi\Car\Model\Car
     */
    protected $dataCar;

    /**
     * Constructor
     *
     * @param \TrainingSurbhi\Car\Model\Car $dataCar
     */
    public function __construct(\TrainingSurbhi\Car\Model\Car $dataCar)
    {
        $this->dataCar = $dataCar;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->dataCar->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
