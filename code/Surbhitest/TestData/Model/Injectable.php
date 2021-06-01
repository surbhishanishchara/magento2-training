<?php
declare(strict_types=1);

namespace Surbhitest\TestData\Model;

Class Injectable implements Injectbaleinterface
{
    function getData():string
    {
        return "this is injectable class !!";
    }
}
?>
