var Polls = function(config) {
    config = config || {};
    Polls.superclass.constructor.call(this, config);
};

Ext.extend(Polls, Ext.Component,{
    page:{}, window:{}, grid:{}, tree:{}, panel:{}, combo:{}, config:{}
});

Ext.reg('polls', Polls);

Polls = new Polls();