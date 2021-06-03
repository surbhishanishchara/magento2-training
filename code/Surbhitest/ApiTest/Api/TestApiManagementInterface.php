<?php

namespace Surbhitest\ApiTest\Api;

interface TestApiManagementInterface
{
    /**
     * get test Api data.
     *
     * @api
     *
     * @param int $id
     *
     * @return \Surbhitest\ApiTest\Api\Data\TestApiInterface
     */
    public function getApiData($id);
}