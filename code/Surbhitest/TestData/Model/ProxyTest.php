<?php
declare(strict_types=1);

namespace Surbhitest\TestData\Model;

Class ProxyTest 
{
    public function slowData() : string
    {
        return "This will give very slow execution";
    }
}

?>