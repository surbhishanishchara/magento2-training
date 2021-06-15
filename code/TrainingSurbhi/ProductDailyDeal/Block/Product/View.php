<?php

namespace TrainingSurbhi\ProductDailyDeal\Block\Product;

class View extends \Magento\Catalog\Block\Product\View
{
    
    public function isCountdownEnabled()
    {
        return $this->getProduct()->getData('deal_status');
    }
    public function getTile()
    {
       return $this->_scopeConfig->getValue('countdown/general/title');
    }

    // public function getCountdownStartDate(){
    //     return $this->getProduct()->getSpecialFromDate();
    // }

    public function getCountdownEndDate(){
        return  $this->getProduct()->getData('deal_time');
    }

    public function getPriceCountDown(){
        
        //if($this->getProduct()->getData('deal_status')){
            $currentDate =  date('d-m-Y');
            $todate      =  $this->getProduct()->getData('deal_time');
            //$fromdate    =  $this->getProduct()->getSpecialFromDate();
            //if($this->getProduct()->getSpecialPrice() != 0 || $this->getProduct()->getSpecialPrice()) {
                if($this->getProduct()->getData('deal_time') != null) {
                    if(strtotime($todate) >= strtotime($currentDate)){
                        return true;
                    }   
                }
           // }
       // }
        return false;
    }
}