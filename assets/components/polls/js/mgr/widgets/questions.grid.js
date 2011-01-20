Polls.grid.Questions = function(config) {
    config = config || {};
	
    Ext.applyIf(config, {
        id: 'polls-grid-questions',
		url: Polls.config.connector_url,
		baseParams: { action: 'mgr/questions/getlist' },
		save_action: 'mgr/questions/updateFromGrid',
		fields: ['id','category','category_name','question','totalVotes','answers','publishdate','unpublishdate','hide','menu'],
		paging: true,
		autosave: true,
		remoteSort: true,
		anchor: '97%',
		autoExpandColumn: 'question',
		columns: [{
				header: _('polls.questionid'),
				dataIndex: 'id',
				sortable: true,
				width: 25
			},{
				header: _('polls.question'),
				dataIndex: 'question',
				sortable: true,
				editor: { xtype: 'textfield' }
			},{
				header: _('polls.category'),
				dataIndex: 'category_name',
				sortable: true
			},{
				header: _('polls.answers'),
				dataIndex: 'answers',
				width: 35,
				sortable: true
			},{
				header: _('polls.questions.votes'),
				dataIndex: 'totalVotes',
				width: 35,
				sortable: true
			},{
				header: _('polls.publishdate'),
				dataIndex: 'publishdate',
				sortable: true,
				width: 75,
				editor: {
					xtype: 'xdatetime', 
					dateFormat: 'd-m-Y', 
					timeFormat: 'H:i'
				}
			},{
				header: _('polls.unpublishdate'),
				dataIndex: 'unpublishdate',
				sortable: true,
				width: 75,
				editor: {
					xtype: 'xdatetime', 
					dateFormat: 'd-m-Y', 
					timeFormat: 'H:i'
				}
			},{
				header: _('polls.hide'),
				dataIndex: 'hide',
				sortable: true,
				width: 40,
				renderer: this.renderYNfield.createDelegate(this,[this],true),
				editor: { xtype: 'combo-boolean' }
			}
		],
		tbar: [{
				text: _('polls.questions.create'),
				handler: {
					xtype: 'question-window-create',
					blankValues: true
				}
			},{
				xtype: 'tbfill'
			},{
				xtype: 'polls-combo-categories',
				name: 'categories',
				id: 'filter-category',
				emptyText: _('polls.category.filter'),
				value: MODx.request.category ? MODx.request.category : null,
				width: 150,
				listeners: {
					'select': { fn: this.filterByCategory, scope:this }
				}
			},{
				xtype: 'tbspacer'
			},{
				xtype: 'textfield',
				id: 'questions-search-filter',
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
	
    Polls.grid.Questions.superclass.constructor.call(this, config);
};

Ext.extend(Polls.grid.Questions, MODx.grid.Grid,{
    search: function(tf, nv, ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },
	filterByCategory: function(cb,rec,ri) {
        this.getStore().baseParams['category'] = rec.data['name'];
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },
	updateQuestion: function(btn, e) {
		if(!this.updatePollQuestionWindow) {
			this.updatePollQuestionWindow = MODx.load({
				xtype: 'polls-window-question-update',
				record: this.menu.record,
				listeners: {
					'success': { fn: this.refresh, scope: this }
				}
			});
		}
		this.updatePollQuestionWindow.setValues(this.menu.record);
		this.updatePollQuestionWindow.show(e.target);
    },
	setupAnswers: function(btn, e) {
        if (!this.menu.record || !this.menu.record.id) return false;
        
        location.href = '?a=' + MODx.request.a + '&action=questions/answers&question=' + this.menu.record.id;
    },
	duplicateQuestion: function(btn, e) {
		MODx.msg.confirm({
			title: _('polls.questions.duplicate'),
			text: _('polls.questions.duplicate_confirm'),
			url: this.config.url,
			params: {
				action: 'mgr/questions/duplicate',
				id: this.menu.record.id
			},
			listeners: {
				'success': { fn:this.refresh, scope:this }
			}
		});
	},
	removeQuestion: function() {
		MODx.msg.confirm({
			title: _('polls.questions.remove'),
			text: _('polls.questions.remove_confirm'),
			url: this.config.url,
			params: {
				action: 'mgr/questions/remove',
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

Ext.reg('polls-grid-questions', Polls.grid.Questions);

// --------------------------
// Create window
Polls.window.CreateQuestion = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		title: _('polls.questions.create'),
		url: Polls.config.connector_url,
		baseParams: {
			action: 'mgr/questions/create'
		},
		fields: [{
				xtype: 'textfield',
				fieldLabel: _('polls.question'),
				name: 'question',
				width: 200,
				allowBlank: false
			},{
				xtype: 'polls-combo-categories',
				fieldLabel: _('polls.category'),
				name: 'category',
				width: 200,
				allowBlank: true
			}
		]
    });
	
    Polls.window.CreateQuestion.superclass.constructor.call(this, config);
};

Ext.extend(Polls.window.CreateQuestion, MODx.Window);
Ext.reg('question-window-create', Polls.window.CreateQuestion);

// --------------------------
// Update window
Polls.window.UpdateQuestion = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('polls.question.update'),
		url: Polls.config.connector_url,
		baseParams: {
            action: 'mgr/questions/update'
        },
		fields: [{
				xtype: 'hidden',
				name: 'id'
			},{
				xtype: 'textfield',
				fieldLabel: _('polls.question'),
				name: 'question',
				width: 200,
				allowBlank: false
			},{
				xtype: 'polls-combo-categories',
				fieldLabel: _('polls.category'),
				name: 'category',
				width: 200,
				allowBlank: true
			},{
				xtype: 'xdatetime',
				fieldLabel: _('polls.publishdate'),
				name: 'publishdate',
				width: 200,
				dateFormat: 'd-m-Y', 
				timeFormat: 'H:i',
				allowBlank: true
			},{
				xtype: 'xdatetime',
				fieldLabel: _('polls.unpublishdate'),
				name: 'unpublishdate',
				width: 200,
				dateFormat: 'd-m-Y', 
				timeFormat: 'H:i',
				allowBlank: true
			},{
				xtype: 'checkbox',
				fieldLabel: _('polls.hide'),
				name: 'hide',
				allowBlank: true
			}
		]
    });
	
    Polls.window.UpdateQuestion.superclass.constructor.call(this, config);
};

Ext.extend(Polls.window.UpdateQuestion, MODx.Window);
Ext.reg('polls-window-question-update', Polls.window.UpdateQuestion);