<?php
namespace TrainingSurbhi\CustomerAttribute\Setup;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;


class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;
    
    private $eavConfig;
    
    private $attributeResource;

    protected $customerSetupFactory;

    
    public function __construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Customer\Model\ResourceModel\Attribute $attributeResource,
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeResource = $attributeResource;
        $this->customerSetupFactory = $customerSetupFactory;
        }

	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.5.0', '<')) {
            $this->createCustomerAttribute($setup);
        }
        $setup->endSetup();
    }//end upgrade()


    /**
     * create country_code customer attribute
     *
     * @param ModuleDataSetupInterface $setup Setup
     */
    private function createCustomerAttribute($setup) : void
    {
            $eavSetup = $this->customerSetupFactory->create(['setup' => $setup]);

            $eavSetup->removeAttribute(Customer::ENTITY, "father_name");

            $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
            $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);

            $eavSetup->addAttribute(Customer::ENTITY, 'father_name', [
                // Attribute parameters
                'type' => 'varchar',
                'label' => "Father's Name",
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'sort_order' => 990,
                'position' => 990,
                'system' => 0,
                'is_used_in_grid'       => true,
                'is_visible_in_grid'    => true,
            ]);
            
            $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'father_name');
            $attribute->setData('attribute_set_id', $attributeSetId);
            $attribute->setData('attribute_group_id', $attributeGroupId);

            /*
            //You can use this attribute in the following forms
            adminhtml_checkout
            adminhtml_customer
            adminhtml_customer_address
            customer_account_create
            customer_account_edit
            customer_address_edit
            customer_register_address
            */

            $attribute->setData('used_in_forms', [
                'adminhtml_customer',
                'customer_account_create',
                'customer_account_edit'
            ]);

            $this->attributeResource->save($attribute);


            $eavSetup = $this->customerSetupFactory->create(['setup' => $setup]);

            $eavSetup->removeAttribute(Customer::ENTITY, "mother_name");

            $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
            $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);

            $eavSetup->addAttribute(Customer::ENTITY, 'mother_name', [
                // Attribute parameters
                'type' => 'varchar',
                'label' => "Mother's Name",
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'sort_order' => 990,
                'position' => 990,
                'system' => 0,
                'is_used_in_grid'       => true,
                'is_visible_in_grid'    => true,
            ]);
            
            $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'mother_name');
            $attribute->setData('attribute_set_id', $attributeSetId);
            $attribute->setData('attribute_group_id', $attributeGroupId);

            /*
            //You can use this attribute in the following forms
            adminhtml_checkout
            adminhtml_customer
            adminhtml_customer_address
            customer_account_create
            customer_account_edit
            customer_address_edit
            customer_register_address
            */

            $attribute->setData('used_in_forms', [
                'adminhtml_customer',
                'customer_account_create',
                'customer_account_edit'
            ]);

            $this->attributeResource->save($attribute);
    }//end createDropdownAttribute()
}

?>