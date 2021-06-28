<?php

namespace TrainingSurbhi\Car\Model\Car\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class CarEngine
 */
class CarEngine implements OptionSourceInterface
{
   
    protected $dataCar;

    protected $options;

    public function __construct(\TrainingSurbhi\Car\Model\Car $dataCar)
    {
        $this->dataCar = $dataCar;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $configOptions = $this->dataCar->getAvailableCarEngine();
        $options = [];
        foreach ($configOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        $this->options = $options;

        return $options;
    }
}
