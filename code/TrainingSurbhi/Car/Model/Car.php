<?php

namespace TrainingSurbhi\Car\Model;

use TrainingSurbhi\Car\Api\Data\CarInterface;

class Car extends \Magento\Framework\Model\AbstractModel implements CarInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'car_data';

    /**
     * @var string
     */
    protected $_cacheTag = 'car_data';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'car_data';

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    const CAR_HONDA = 'honda';
    const CAR_SKODA = 'skoda';
    const CAR_BMW = 'bmw';
    const CAR_AUDI = 'audi';

    const ENGINE_PETROL = 'petrol';
    const ENGINE_DIESEL = 'diesel';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('TrainingSurbhi\Car\Model\ResourceModel\Car');
    }
    /**
     * Get CarId.
     *
     * @return int
     */
    public function getCarId()
    {
        return $this->getData(self::CAR_ID);
    }

    /**
     * Set CarId.
     */
    public function setCarId($carId)
    {
        return $this->setData(self::CAR_ID, $carId);
    }

    /**
     * Get CarName.
     *
     * @return varchar
     */
    public function getCarName()
    {
        return $this->getData(self::CAR_NAME);
    }

    /**
     * Set CarName.
     */
    public function setCarName($carname)
    {
        return $this->setData(self::CAR_NAME, $carname);
    }

    /**
     * Get Company.
     *
     * @return varchar
     */
    public function getCompany()
    {
        return $this->getData(self::COMPANY);
    }

    /**
     * Set Company.
     */
    public function setCompany($company)
    {
        return $this->setData(self::COMPANY, $company);
    }

    /**
     * Get Country.
     *
     * @return varchar
     */
    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * Set Country.
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * Get CarDescription.
     *
     * @return varchar
     */
    public function getCarDescription()
    {
        return $this->getData(self::CAR_DESCRIPTION);
    }

    /**
     * Set CarDescription.
     */
    public function setCarDescription($car_description)
    {
        return $this->setData(self::CAR_DESCRIPTION, $car_description);
    }

    /**
     * Get EngineType.
     *
     * @return varchar
     */
    public function getEngineType()
    {
        return $this->getData(self::ENGINE_TYPE);
    }

    /**
     * Set EngineType.
     */
    public function setEngineType($engine_type)
    {
        return $this->setData(self::ENGINE_TYPE, $engine_type);
    }

    /**
     * Get ExtraFeature.
     *
     * @return varchar
     */
    public function getExtraFeature()
    {
        return $this->getData(self::EXTRA_FEATURE);
    }

    /**
     * Set ExtraFeature.
     */
    public function setExtraFeature($extra_feature)
    {
        return $this->setData(self::EXTRA_FEATURE, $extra_feature);
    }


    /**
     * Get UsageInfo.
     *
     * @return varchar
     */
    public function getUsageInfo()
    {
        return $this->getData(self::WEIGHT);
    }

    /**
     * Set UsageInfo.
     */
    public function setUsageInfo($usage_info)
    {
        return $this->setData(self::USAGE_INFO, $usage_info);
    }

    /**
     * Get Image.
     *
     * @return varchar
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * Set Image.
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

     /**
     * Get Color.
     *
     * @return varchar
     */
    public function getColor()
    {
        return $this->getData(self::COLOR);
    }

    /**
     * Set Color.
     */
    public function setColor($color)
    {
        return $this->setData(self::COLOR, $color);
    }

     /**
     * Get IsActive.
     *
     * @return int
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set IsActive.
     */
    public function setIsActive($is_active)
    {
        return $this->setData(self::IS_ACTIVE, $is_active);
    }

    /**
     * Get UpdateTime.
     *
     * @return varchar
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Set UpdateTime.
     */
    public function setUpdateTime($update_time)
    {
        return $this->setData(self::UPDATE_TIME, $update_time);
    }

    /**
     * Get CreationTime.
     *
     * @return varchar
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Set CreationTime.
     */
    public function setCreationTime($creation_time)
    {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }

    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    public function getAvailableCarCompany()
    {
        return [self::CAR_HONDA => __('Honda'), self::CAR_SKODA => __('Skoda'), self::CAR_BMW => __('BMW'), self::CAR_AUDI => __('Audi')];
    }

    public function getAvailableCarEngine()
    {
        return [self::ENGINE_PETROL => __('Petrol'), self::ENGINE_DIESEL => __('Diesel')];
    }
}