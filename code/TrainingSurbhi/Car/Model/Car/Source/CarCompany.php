<?php

namespace TrainingSurbhi\Car\Model\Car\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class CarCompany
 */
class CarCompany implements OptionSourceInterface
{
   
    protected $dataCar;

    protected $options;

    /**
     * Constructor
     *
     * @param BuilderInterface $pageLayoutBuilder
     */
    public function __construct(\TrainingSurbhi\Car\Model\Car $dataCar)
    {
        $this->dataCar = $dataCar;
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $configOptions = $this->dataCar->getAvailableCarCompany();
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
