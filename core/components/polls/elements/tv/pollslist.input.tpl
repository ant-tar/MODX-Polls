<input id="tv{$tv->id}" type="text" />

{literal}
<script type="text/javascript">
// <![CDATA[
Ext.onReady(function() {
    var pollStore{/literal}{$tv->id}{literal} = new Ext.data.ArrayStore({
        fields: ['id','question'],
        data: {/literal}{$list}{literal}
    });
	
	var fld = MODx.load({{/literal}
        xtype: 'combo'
		,store: pollStore{$tv->id}
        ,displayField: 'question'
        ,valueField: 'id'
        ,name: 'tv{$tv->id}'
        ,hiddenName: 'tv{$tv->id}'
        ,mode: 'local'
        ,triggerAction: 'all'
        ,applyTo: 'tv{$tv->id}'
        ,value: '{$tv->value}'
		,width: 400
		,typeAhead: true
		,typeAheadDelay: 250
		,allowBlank: {if $params.allowBlank == 1 || $params.allowBlank == 'true'}true{else}false{/if}
		,msgTarget: 'under'
        ,listeners: { 'select': { fn:MODx.fireResourceFormChange, scope:this}}
        
    {literal}});

    var pr = Ext.getCmp('modx-panel-resource');
    if (pr) {
        pr.getForm().add(fld);
    }
    MODx.makeDroppable(fld);
});
// ]]>
</script>
{/literal}