Ext.onReady(function() {
    MODx.load({ xtype: 'polls-page-index'});
});

Polls.page.Index = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		components: [{
			xtype: 'polls-panel-index',
			renderTo: 'polls-panel-index-div'
		}]
	});
	
	Polls.page.Index.superclass.constructor.call(this, config);
};

Ext.extend(Polls.page.Index, MODx.Component);
Ext.reg('polls-page-index', Polls.page.Index);