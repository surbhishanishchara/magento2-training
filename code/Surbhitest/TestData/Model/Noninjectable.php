<?php
declare(strict_types=1);

namespace Surbhitest\TestData\Model;

Class Noninjectable implements Noninjectableinterface
{
    function getData():string
    {
        return "this is Noninjectable class !!";
    }
}

?>