define([
    'jquery',
    'uiRegistry',
    'underscore',
    'mageUtils',
    'Magento_Ui/js/form/element/abstract',
    'Magento_Ui/js/modal/modal'
], function ($,registry,_,utils,Abstract) {
    'use strict';

    return Abstract.extend({
        defaults: {
            externalListingName: '${ $.ns }.${ $.ns }',
            prefixName: '',
            prefixElementName: '',
            elementName: '',
            suffixName: '',
            viewProductButtonLabel: $.mage.__('Select product'),
            dialogContainerTmpl: '',
            recordId:'',
        },

        /**
         *
         * @param index
         * @param recordId
         * @param record
         * @returns {boolean}
         */
        processingViewProducts: function (index, recordId, record) {
            var self = this;
            if(record.data()) {
                var recordData = record.data();
                if(_.isArray(recordData.category_ids) || _.isNull(recordData.category_ids)) {
                    alert("Please select any one category");
                    return false;
                }
                var categoryId = record.data().category_ids;
                var productIds = record.data().product_selected_ids;
                var ajaxParams = {'category_id':categoryId};
                if(productIds) {
                    ajaxParams = {'category_id':categoryId,'product_selected_ids':productIds}
                }
                self.makeRequest(ajaxParams,'',self.productsUrl);
            } else {
                alert("Please select any one category");
                return false;
            }
        },

        /**
         *
         * @param record
         * @returns {string}
         */
        defineDataRole: function (record) {
            return 'products_modal_'+this.parentName.split('.').last();
        },

        /**
         * Make ajax request
         * @param params
         */
        makeRequest : function(params)
        {
            var self = this;
            var result = '?';
            _.each(params, function (value, key) {
                result += key + '=' + value + '&';
            });
            params = result.slice(0, -1);
            var data = utils.serialize(data);
            data['form_key'] = window.FORM_KEY;
            $('body').trigger('processStart');
            $.ajax({
                url: self.productsUrl + params,
                data: data,
                dataType: 'json',
                success: function (resp) {
                    self.initDialog(resp);
                },

                complete: function () {
                    $('body').trigger('processStop');
                }
            });
        },

        /**
         *
         * @param config
         * @returns {exports}
         */
        initConfig: function (config) {
            this._super(config);
            this.recordId = this.parentName.split('.').last();
            this.dialogContainerTmpl = '[data-role=products_modal_'+this.recordId+']';
            return this;
        },

        /**
         *
         * @param resp
         */
        initDialog: function (resp) {
            var self = this;
            var $dialog = $(self.dialogContainerTmpl);
            $dialog.modal({
                type: 'slide',
                responsive: true,
                innerScroll: true,
                buttons: [{
                    text: $.mage.__('Add selected products'),
                    class: 'primary action submit btn btn-default',
                    click: function () {
                        $dialog.trigger('add');
                        this.closeModal();
                    }
                }],

                /** @inheritdoc */
                opened: function () {
                    $dialog.trigger('open');
                },

                /** @inheritdoc */
                closed: function () {
                    $dialog.trigger('close');
                }
            });
            $dialog.html(resp.content).modal('openModal');
            $dialog.on('open', function () {
                this.getElementsBySelector("#product_ids")[0].value = registry.get(
                    self.parentName+'.product_selected_ids'
                ).value();
            });
            $dialog.on('close', function () {
                $dialog.html('');
            });
            $dialog.on('add', function () {
                var values = $('#product_ids').val();
                registry.get(self.parentName+'.product_selected_ids').value(values);
            });
        },
    });
});