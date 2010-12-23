Ext.onReady(function() {
    MODx.load({ xtype: 'polls-page-answers'});
});

Polls.page.Answers = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		buttons: [{
			text: _('polls.answers.btnback'),
			id: 'answers-btn-back',
			handler: function() {
				location.href = '?a=' + MODx.request.a;
			},
			scope: this
		}],
		components: [{
			xtype: 'polls-panel-answers',
			renderTo: 'question-panel-answers-div',
			question: MODx.request.question
		}]
	});
	
	Polls.page.Answers.superclass.constructor.call(this, config);
};

Ext.extend(Polls.page.Answers, MODx.Component);
Ext.reg('polls-page-answers', Polls.page.Answers);