define([
    'Magento_Catalog/js/components/new-category'
], function (Select) {
    'use strict';

    return Select.extend({
        sliderType: function (value) {
            this.multiple = true;
            switch (value) {
                case 'new_with_category':
                    this.setValidation('required-entry',true);
                    this.required(true);
                    break;
                case 'sale_with_category':
                    this.setValidation('required-entry',true);
                    this.required(true);
                    break;
                case 'featured_with_category':
                    this.setValidation('required-entry',true);
                    this.required(true);
                    break;
                case 'bestseller_with_category':
                    this.setValidation('required-entry',true);
                    this.required(true);
                    break;
                case 'category':
                    this.setValidation('required-entry',true);
                    this.required(true);
                    this.multiple = false;
                    break;
                case 'specific_product_with_category':
                    this.setValidation('required-entry',true);
                    this.required(true);
                    this.multiple = true;
                    break;
                default:
                    this.setValidation('required-entry',false);
                    this.required(false);
            }
        }
    });
});
