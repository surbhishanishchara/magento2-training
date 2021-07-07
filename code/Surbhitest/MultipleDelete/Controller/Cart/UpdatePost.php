<?php
namespace Surbhitest\MultipleDelete\Controller\Cart;

class UpdatePost extends \Magento\Checkout\Controller\Cart\UpdatePost
{

    public function execute()
    {
        if (!$this->_formKeyValidator->validate($this->getRequest())) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        $updateAction = (string)$this->getRequest()->getParam('update_cart_action');
        switch ($updateAction) {
            case 'empty_cart':
                $this->_emptyShoppingCart();
                break;
            case 'update_qty':
                $this->_updateShoppingCart();
                break;
            case 'delete_items':
                $multiDelete = $this->getRequest()->getParam('select_product');
                $cartProductIds = $this->cart->getQuoteProductIds();
                if (count($cartProductIds) == count($multiDelete)) {
                    $this->_emptyShoppingCart();
                } elseif (!empty($multiDelete)) {
                    $this->_removeCartItems($multiDelete);
                }
                break;
            default:
                $this->_updateShoppingCart();
        }

        return $this->_goBack();
    }

    private function _removeCartItems($multiDelete)
    {
        try {
            foreach ($multiDelete as $_itemQuoteId) {
                $this->cart->removeItem($_itemQuoteId);
            }
            $this->cart->save();
        } catch (\Magento\Framework\Exception\LocalizedException $exception) {
            $this->messageManager->addError($exception->getMessage());
        } catch (\Exception $exception) {
            $this->messageManager->addException($exception, __('We can\'t delete the shopping cart.'));
        }
    }
}
