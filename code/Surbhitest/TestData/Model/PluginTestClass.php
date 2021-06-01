<?php
declare(strict_types=1);

namespace Surbhitest\TestData\Model;

Class PluginTestClass
{

    public function getPluginMessage($msg,$msg_1) : string
    {
        return $msg." Message 1 ".$msg_1;
    }

}
?>