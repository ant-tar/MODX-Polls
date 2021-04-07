/**
 * Categories combobox
 */
Polls.combo.CategoryList = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        name: 'category',
		hiddenName: 'category',
		displayField: 'name',
		valueField: 'id',
		fields: ['id','name'],
		forceSelection: true,
		typeAhead: true,
		editable: false,
		allowBlank: true,
		autocomplete: true,
		url: Polls.config.connectorUrl,
		baseParams: {
            action: 'mgr/categories/getList',
			combo: true
        }
    });
	
    Polls.combo.CategoryList.superclass.constructor.call(this, config);
};

Ext.extend(Polls.combo.CategoryList, MODx.combo.ComboBox);
Ext.reg('polls-combo-categories', Polls.combo.CategoryList);