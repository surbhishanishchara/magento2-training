<?php

namespace Surbhitest\DynamicRows\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class DynamicRows extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('dynamic_rows', 'dynamic_rows_id');
    }

    public function deleteDynamicRows()
    {
        $connection = $this->getConnection();
        $connection->delete(
            $this->getMainTable(),
            ['dynamic_rows_id > ?' => 0]
        );
    }
}
