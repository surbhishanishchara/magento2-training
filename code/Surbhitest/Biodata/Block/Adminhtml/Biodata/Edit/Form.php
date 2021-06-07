<?php

namespace Surbhitest\Biodata\Block\Adminhtml\Biodata\Edit;


/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Surbhitest\Biodata\Model\Status $options,
        array $data = []
    ) 
    {
        $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form', 
                            'enctype' => 'multipart/form-data', 
                            'action' => $this->getData('action'), 
                            'method' => 'post'
                        ]
            ]
        );

        $form->setHtmlIdPrefix('wkgrid_');
        if ($model->getBiodataId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('biodata_id', 'hidden', ['name' => 'biodata_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Biodata'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'id' => 'name',
                'title' => __('Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'father_name',
            'text',
            [
                'name' => 'father_name',
                'label' => __('Father Name'),
                'id' => 'father_name',
                'title' => __('Father Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'mother_name',
            'text',
            [
                'name' => 'mother_name',
                'label' => __('Mother Name'),
                'id' => 'mother_name',
                'title' => __('Mother Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'gender', 
            'radios',
            [
                'label' => __('Gender'),
                'title' => __('Gender'),
                'name' => 'gender',
                'required' => true,
                'values' => array(
                        array('value'=>'male','label'=>'Male'),
                        array('value'=>'female','label'=>'Female'),
                ),
                'value' => 'male',
            ]
        );

        $fieldset->addField(
            'contact_number',
            'text',
            [
                'name' => 'contact_number',
                'label' => __('Contact Number'),
                'id' => 'contact_number',
                'title' => __('Contact Number'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'id' => 'email',
                'title' => __('Email'),
                'class' => 'required-entry',
                'required' => false,
            ]
        );

        $fieldset->addField(
            'height',
            'text',
            [
                'name' => 'height',
                'label' => __('Height'),
                'id' => 'height',
                'title' => __('Height'),
                'class' => 'required-entry',
                'required' => false,
            ]
        );

        $fieldset->addField(
            'weight',
            'text',
            [
                'name' => 'weight',
                'label' => __('Weight'),
                'id' => 'weight',
                'title' => __('Weight'),
                'class' => 'required-entry',
                'required' => false,
            ]
        );

        $fieldset->addField(
            'dob',
            'date',
            [
                'name' => 'dob',
                'label' => __('Date of Birth'),
                'date_format' => $dateFormat,
                'time_format' => 'HH:mm:ss',
                'class' => 'validate-date validate-date-range date-range-custom_theme-from',
                'class' => 'required-entry',
                'style' => 'width:200px',
            ]
        );

        // $fieldset->addField(
        //     'hobby',
        //     'multiselect',
        //     [
        //         'values' => ['dancing' => __('Dancing'), 'drawing' => __('Drawing'), 'reading' => __('Reading'), 'explore_new_places' => __('Explore New Places')],
        //         'name' => 'hobby[]',
        //         'label' => __('Hobby'),
        //         'title' => __('Hobby'),
        //         'class' => 'hobby'
        //     ]
        // );

        $fieldset->addField(
            'hobby',
            'multiselect',
            [
                'name' => 'hobby',
                'label' => __('Hobby'),
                'title' => __('Hobby'),
                'required' => false,
                'can_be_empty' => true,
                'values' =>  array(
                    array('value'=>'dancing','label'=>'Dancing'),
                    array('value'=>'drawing','label'=>'Drawing'),
                    array('value'=>'reading','label'=>'Reading'),
                    array('value'=>'explore_new_places','label'=>'Explore New Places'),
               ),
            //    'note' => __('Select websites you want to exclude from this customer group.')
            ]
        );


        $fieldset->addField(
            'complexion',
            'select',
            [
                'values' => ['very_fair' => __('Very Fair'), 'fair' => __('Fair'), 'medium' => __('Medium'), 'dark' => __('Dark')],
                'name' => 'complexion',
                'label' => __('Complexion'),
                'title' => __('Complexion'),
                'class' => 'complexion'
            ]
        );

        $fieldset->addField(
            'address',
            'textarea',
            [
                'name' => 'address',
                'label' => __('Address'),
                'id' => 'address',
                'title' => __('Address'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addType('candidate_image','Surbhitest\Biodata\Model\Image\Image');
        $fieldset->addField(
            'candidate_image',
            'image',
            [
                'name' => 'candidate_image',
              //  'renderer'  => 'Surbhitest\Biodata\Helper\Image\Custom',
                'label' => __('Candidate Image'),
                'title' => __('Candidate Image'),
                'required'  => true,
                'initialMediaGalleryOpenSubpath'=>'biodata_image',
                //'disabled' => $isElementDisabled
            ]
        );

        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        $fieldset->addField(
            'about_self',
            'editor',
            [
                'name' => 'about_self',
                'label' => __('Write About Your Self'),
                'style' => 'height:36em;',
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );

        $fieldset->addField(
            'is_horoscope',
            'checkbox',
            [
                'label' => __('Believe in Horoscope?'),
                'name' => 'is_horoscope',
                'checked' => true
                //'data-form-part' => $this->getData('edit_form'),
                //'onchange' => 'this.value = this.checked;'
            ]
        );

        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'id' => 'status',
                'title' => __('Status'),
                'values' => $this->_options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}