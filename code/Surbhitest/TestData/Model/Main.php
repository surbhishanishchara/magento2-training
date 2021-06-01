<?php
declare(strict_types=1);

namespace Surbhitest\TestData\Model;

Class Main
{
    protected array $data;
    protected Injectbaleinterface $injectable;
    protected NoninjectableinterfaceFactory $Noninjectable;
    protected AbstractTest $AbstractTest;
    protected ProxyTest $ProxyTest;
    protected PluginTestClass $PluginTestClass;
    
    public function __construct(
        Injectbaleinterface $injectable,
        NoninjectableinterfaceFactory $Noninjectable,
        AbstractTest $AbstractTest,
        ProxyTest $ProxyTest,
        PluginTestClass $PluginTestClass,
        array $data = [])
   {
        $this->data = $data;
        $this->injectable = $injectable;
        $this->Noninjectable = $Noninjectable;
        $this->AbstractTest = $AbstractTest;
        $this->ProxyTest = $ProxyTest;
        $this->PluginTestClass = $PluginTestClass;
    }

    public function getData() : string
    {
        return $this->data['id'];
    }

    public function getInjectable() : Injectable
    {
        return $this->injectable;
    }

    public function getNonInjectable() : Noninjectable
    {
        return $this->Noninjectable->create();
    }

    public function getAbstractTest() : AbstractTest
    {
        return $this->AbstractTest;
    }
    public function getProxyTest() : ProxyTest
    {
        return $this->ProxyTest;
    }
    public function getPluginTestClass() : PluginTestClass
    {
        return $this->PluginTestClass;
    }
}
?>