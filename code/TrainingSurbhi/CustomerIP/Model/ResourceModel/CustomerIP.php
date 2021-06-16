<?php

namespace TrainingSurbhi\CustomerIP\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomerIP extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('allowed_customer_ip', 'customer_ip_id');
    }

    public function deleteCustomerIP()
    {
        $connection = $this->getConnection();
        $connection->delete(
            $this->getMainTable(),
            ['customer_ip_id > ?' => 0]
        );
    }
}
