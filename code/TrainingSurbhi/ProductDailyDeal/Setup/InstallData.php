<?php
namespace TrainingSurbhi\ProductDailyDeal\Setup;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

private $eavSetupFactory;

/**
* Init
*
* @param EavSetupFactory $eavSetupFactory
*/
public function __construct(EavSetupFactory $eavSetupFactory)
{
    $this->eavSetupFactory = $eavSetupFactory;
}

public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
{
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            /**
            * Add attributes to the eav/attribute
            */

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'deal_status',
                [
                    'group' => 'Daily Deal',
                    'type' => 'int',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Deal Status',
                    'input' => 'boolean',
                    'class' => '',
                    'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => false,
                    'default' => '1',
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => false,
                    'unique' => false,
                    'apply_to' => ''
                ]
            );

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'deal_time',
                [
                    'group' => 'Daily Deal',
                    'type' => 'datetime',
                    'backend' => '',
                    'frontend' => 'Magento\Eav\Model\Entity\Attribute\Frontend\Datetime',
                    'label' => 'Deal Starting Time',
                    'input' => 'date',
                    'class' => '',
                    'source' => '',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => false,
                    'default' => '',
                    'sort_order' => 9,
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => true,
                    'unique' => false,
                    'apply_to' => ''
                ]
            ); 
    }
}