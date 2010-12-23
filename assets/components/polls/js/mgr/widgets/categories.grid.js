Polls.grid.Categories = function(config) {
    config = config || {};
	
    Ext.applyIf(config, {
        id: 'polls-grid-categories',
		url: Polls.config.connector_url,
		baseParams: { action: 'mgr/categories/getlist' },
		save_action: 'mgr/categories/updateFromGrid',
		fields: ['id','name','menu'],
		paging: true,
		autosave: true,
		remoteSort: true,
		anchor: '97%',
		autoExpandColumn: 'name',
		columns: [{
				header: _('polls.categoryid'),
				dataIndex: 'id',
				sortable: true,
				width: 15
			},{
				header: _('polls.category'),
				dataIndex: 'name',
				sortable: true,
				editor: { xtype: 'textfield' }
			}
		],
		tbar: [{
				text: _('polls.categories.create'),
				handler: {
					xtype: 'category-window-create',
					blankValues: true
				}
			},{
				xtype: 'tbfill'
			},{
				xtype: 'textfield',
				id: 'categories-search-filter',
				emptyText: _('polls.search'),
				listeners: {
					'change': { fn: this.search, scope:this },
					'render': { fn: function(tf) {
							tf.getEl().addKeyListener(Ext.EventObject.ENTER, function() {
								this.search(tf);
							}, this);
						},
						scope: this
					}
				}
			}
		]
    });
	
    Polls.grid.Categories.superclass.constructor.call(this, config);
};

Ext.extend(Polls.grid.Categories, MODx.grid.Grid,{
    search: function(tf, nv, ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },
	removeCategory: function() {
		MODx.msg.confirm({
			title: _('polls.categories.remove'),
			text: _('polls.categories.remove_confirm'),
			url: this.config.url,
			params: {
				action: 'mgr/categories/remove',
				id: this.menu.record.id
			},
			listeners: {
				'success': { fn:this.refresh, scope:this }
			}
		});
    },
	renderYNfield: function(v,md,rec,ri,ci,s,g) {
        var r = s.getAt(ri).data;
        v = Ext.util.Format.htmlEncode(v);
        var f = MODx.grid.Grid.prototype.rendYesNo;
        return f(v,md,rec,ri,ci,s,g);
    }
});

Ext.reg('polls-grid-categories', Polls.grid.Categories);

// --------------------------
// Create window
Polls.window.CreateCategory = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		title: _('polls.categories.create'),
		url: Polls.config.connector_url,
		baseParams: {
			action: 'mgr/categories/create'
		},
		fields: [{
				xtype: 'textfield',
				fieldLabel: _('polls.category'),
				name: 'name',
				width: 200,
				allowBlank: false
			}
		]
    });
	
    Polls.window.CreateCategory.superclass.constructor.call(this, config);
};

Ext.extend(Polls.window.CreateCategory, MODx.Window);
Ext.reg('category-window-create', Polls.window.CreateCategory);