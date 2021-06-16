<?php
namespace TrainingSurbhi\CustomShipping\Model\Carrier;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Rate\Result;
use Magento\Ups\Helper\Config;
use Magento\Shipping\Model\Carrier\AbstractCarrier;

class Shipping extends AbstractCarrier implements CarrierInterface
{
    const CODE = 'customshippingdemo';
    protected $_code = self::CODE;
    protected $_isFixed = true;
    protected $rateResultFactory;
    protected $rateMethodFactory;   
    protected $storeManager;
 
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->rateResultFactory = $rateResultFactory;
        $this->rateMethodFactory = $rateMethodFactory;
        $this->storeManager = $storeManager;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }
 
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }
        $result = $this->rateResultFactory->create();
        $storeId = $this->storeManager->getStore()->getId();
        $price = $this->getConfigData('price');
        if ($price == "") {
            $price = 10; // By default price if price value is blank
        }
        $method = $this->rateMethodFactory->create();
        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod($this->_code);
        $method->setMethodTitle($this->getConfigData('name'));
        $method->setCost($price);
        $method->setPrice($price);
        $result->append($method);
        return $result;
    }
   
    public function getAllowedMethods()
    {
        return [$this->_code => __($this->getConfigData('name'))];
    }
}