Polls.grid.Answers = function(config) {
    config = config || {};
	
    Ext.applyIf(config, {
        id: 'polls-grid-answers',
		url: Polls.config.connector_url,
		baseParams: {
			action: 'mgr/answers/getlist',
			id: MODx.request.question
		},
		save_action: 'mgr/answers/updateFromGrid',
		fields: ['id','answer','votes','percents','sort_order','menu'],
		autosave: true,
		remoteSort: true,
		anchor: '97%',
		autoExpandColumn: 'answer',
		columns: [{
			header: _('polls.answerid'),
			dataIndex: 'id',
			sortable: true,
			width: 20
		},{
			header: _('polls.answer'),
			dataIndex: 'answer',
			sortable: true,
			editor: { xtype: 'textfield' }
		},{
			header: _('polls.answers.votes'),
			dataIndex: 'votes',
			sortable: true,
			width: 30
		},{
			header: _('polls.answers.percents'),
			dataIndex: 'percents',
			sortable: true,
			width: 30
		},{
			header: _('polls.answers.sort'),
			dataIndex: 'sort_order',
			sortable: true,
			width: 30,
			editor: { xtype: 'textfield' }
		}],
		tbar: [{
			text: _('polls.answers.create'),
			handler: {
				xtype: 'answer-window-create',
				blankValues: true
			}
		},{
			xtype: 'tbfill'
		},{
			xtype: 'textfield',
			id: 'answers-search-filter',
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
		}]
    });
	
    Polls.grid.Answers.superclass.constructor.call(this, config);
};

Ext.extend(Polls.grid.Answers, MODx.grid.Grid,{
    search: function(tf, nv, ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.refresh();
    },
	removeAnswer: function() {
		MODx.msg.confirm({
			title: _('polls.answers.remove'),
			text: _('polls.answers.remove_confirm'),
			url: this.config.url,
			params: {
				action: 'mgr/answers/remove',
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

Ext.reg('polls-grid-answers', Polls.grid.Answers);

// --------------------------
// Create window
Polls.window.CreateAnswer = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		title: _('polls.answers.create'),
		url: Polls.config.connector_url,
		baseParams: {
			action: 'mgr/answers/create'
		},
		width: 450,
		fields: [{
			xtype: 'hidden',
			name: 'question',
			value: MODx.request.question
		},{
			xtype: 'textfield',
			fieldLabel: _('polls.answer'),
			name: 'answer',
			anchor: '100%',
			allowBlank: false
		}]
    });
	
    Polls.window.CreateAnswer.superclass.constructor.call(this, config);
};

Ext.extend(Polls.window.CreateAnswer, MODx.Window);
Ext.reg('answer-window-create', Polls.window.CreateAnswer);