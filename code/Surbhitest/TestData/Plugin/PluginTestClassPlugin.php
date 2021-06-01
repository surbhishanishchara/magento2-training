<?php
declare(strict_types=1);

namespace Surbhitest\TestData\Plugin;

use Surbhitest\TestData\Model\PluginTestClass;

class PluginTestClassPlugin
{
  /*   public function beforeGetPluginMessage(PluginTestClass $subject,string $msg,string $msg_1){
        $msg = $msg."This is message from plugin before function!! ";
        return [$msg,$msg_1];
    }

    public function afterGetPluginMessage(PluginTestClass $subject,$result,string $msg,string $msg_1){
        return "We are printing Msg again from after get plugin message".$msg." ".$result."</br>";
    } */

    public function aroundGetPluginMessage(PluginTestClass $subject,callable $proceed,string $msg,string $msg_1){
        $msg .= "Msg variable in around function";
        $result = $proceed($msg ,$msg_1);

        $result .= "Around function message ".$msg_1;
        return $result;
    }
}
?>