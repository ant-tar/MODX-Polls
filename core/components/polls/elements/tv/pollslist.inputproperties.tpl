<div id="tv-input-properties-form{$tv}"></div>

{literal}
<script type="text/javascript">
// <![CDATA[
var params = {
{/literal}{foreach from=$params key=k item=v name='p'}
 '{$k}': '{$v|escape:"javascript"}'{if NOT $smarty.foreach.p.last},{/if}
{/foreach}{literal}
};
var oc = {'change':{fn:function(){Ext.getCmp('modx-panel-tv').markDirty();},scope:this}};
var categoriesStore = new Ext.data.ArrayStore({
	fields: ['id','category'],
	data: {/literal}{$categories}{literal}
});

MODx.load({
	xtype: 'panel'
    ,layout: 'form'
    ,cls: 'form-with-labels'
    ,labelAlign: 'top'
    ,autoHeissght: true
    ,border: false
	,defaults: { width: 300 ,layout: 'form' ,msgTarget: 'side' ,labelSeparator: '' }
    ,items: [{
        xtype: 'combo-boolean'
        ,fieldLabel: _('required')
        ,description: _('required_desc')
        ,name: 'inopt_allowBlank'
        ,hiddenName: 'inopt_allowBlank'
        ,id: 'inopt_allowBlank{/literal}{$tv}{literal}'
        ,value: params['allowBlank'] == 0 || params['allowBlank'] == 'false' ? false : true
        ,listeners: oc
    },{
		xtype: MODx.expandHelp ? 'label' : 'hidden'
		,forId: 'inopt_allowBlank{/literal}{$tv}{literal}'
		,html: _('required_desc')
		,cls: 'desc-under'
		,anchor: '100%'
	},{
		xtype: 'combo'
		,store: categoriesStore
		,id: 'inopt_category{/literal}{$tv}{literal}'
		,fieldLabel: '{/literal}{$pls.category}{literal}'
		,description: '{/literal}{$pls.category_desc}{literal}'
        ,displayField: 'category'
        ,valueField: 'id'
        ,name: 'inopt_category'
		,hiddenName: 'inopt_category'
        ,mode: 'local'
        ,triggerAction: 'all'
		,typeAhead: true
		,typeAheadDelay: 250
		,allowBlank: true
		,msgTarget: 'under'
        ,listeners: { 'select': { fn:function() { Ext.getCmp('modx-panel-tv').markDirty(); }, scope:this}}
	},{
		xtype: MODx.expandHelp ? 'label' : 'hidden'
		,forId: 'inopt_category{/literal}{$tv}{literal}'
		,html: '{/literal}{$pls.category_desc}{literal}'
		,cls: 'desc-under'
		,anchor: '100%'
	}]
	,renderTo: 'tv-input-properties-form{/literal}{$tv}{literal}'
});
// ]]>
</script>
{/literal}