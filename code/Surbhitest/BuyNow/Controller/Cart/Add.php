<?php

namespace Surbhitest\BuyNow\Controller\Cart;

use Magento\Framework\Data\Form\FormKey;
use Magento\Catalog\Api\ProductRepositoryInterface;


class Add extends \Magento\Checkout\Controller\Cart\Add
{
    protected $resolverInterface;

    protected $helperData;

    protected $cartHelper;

    protected $psrInterface;

    protected $escaper;

    protected $scopeConfig;

    protected $formKey;

    protected $cartModel;

    protected $productRepository;
    
    public function __construct(
        FormKey $formKey,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Checkout\Model\Cart $cartModel,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Locale\ResolverInterface $resolverInterface,
        \Surbhitest\BuyNow\Helper\Data $helperData,
        \Magento\Checkout\Helper\Cart $cartHelper,
        \Psr\Log\LoggerInterface $psrInterface,
        \Magento\Framework\Escaper $escaper
    ) {
        parent::__construct(
            $context,
            $scopeConfig,
            $checkoutSession,
            $storeManager,
            $formKeyValidator,
            $cartModel,
            $productRepository
        );
        $this->resolverInterface = $resolverInterface;
        $this->helperData = $helperData;
        $this->cartHelper = $cartHelper;
        $this->psrInterface = $psrInterface;
        $this->escaper = $escaper;
        $this->scopeConfig = $scopeConfig;
        $this->formKey = $formKey;
        $this->cartModel = $cartModel;
        $this->resultPageFactory = $resultPageFactory;
        $this->productRepository = $productRepository;
    }

    public function execute()
    {
        if (!$this->_formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addErrorMessage(
                __('Your session has expired')
            );
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        $params = $this->getRequest()->getParams();

        try {
            if (isset($params['qty'])) {
                $filter = new \Zend_Filter_LocalizedToNormalized(
                    ['locale' => $this->resolverInterface->getLocale()]
                );
                $params['qty'] = $filter->filter($params['qty']);
            }

            $product = $this->_initProduct();
            $related = $this->getRequest()->getParam('related_product');

            /**
             * Check product availability
             */
            if (!$product) {
                return $this->goBack();
            }

            $cartProducts = $this->helperData->keepCartProducts();
            if (!$cartProducts) {
                $this->cart->truncate(); //remove all products from cart
            }

            $this->cart->addProduct($product, $params);
            if (!empty($related)) {
                $this->cart->addProductsByIds(explode(',', $related));
            }

            $this->cart->save();

            $this->_eventManager->dispatch(
                'checkout_cart_add_product_complete',
                ['product' => $product, 'request' => $this->getRequest(), 'response' => $this->getResponse()]
            );

            if (!$this->_checkoutSession->getNoCartRedirect(true)) {
                $baseUrl = $this->_url->getBaseUrl();
                return $this->goBack($baseUrl . 'checkout/', $product);
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            if ($this->_checkoutSession->getUseNotice(true)) {
                $this->messageManager->addNoticeMessage(
                    $this->escaper->escapeHtml($e->getMessage())
                );
            } else {
                $messages = array_unique(explode("\n", $e->getMessage()));
                foreach ($messages as $message) {
                    $this->messageManager->addErrorMessage(
                        $this->escaper->escapeHtml($message)
                    );
                }
            }
            $url = $this->_checkoutSession->getRedirectUrl(true);
            if (!$url) {
                $cartUrl = $this->cartHelper->getCartUrl();
                $url = $this->_redirect->getRedirectUrl($cartUrl);
            }
            return $this->goBack($url);
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('We can\'t add this item to your shopping cart right now.'));
            $this->psrInterface->critical($e);
            return $this->goBack();
        }
    }
}