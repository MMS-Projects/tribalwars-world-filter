App.views.HtmlPage = Ext.extend(Ext.Panel, {
    styleHtmlContent: true,
    scroll: true,
    initComponent: function(){
        var pane = this,

        infoCard = {
            id: 'info_' + pane.slug,
            cls: 'page',
            styleHtmlContent: true,
        };
        Ext.apply(this, {
            layout: 'vbox',
            cardSwitchAnimation: 'flip',
            cls: 'pagecard',

            items: [  infoCard ],
            dockedItems: [
                {
                    xtype: 'toolbar',
                    title: pane.title,
                    items: [ { xtype: 'spacer' } ]
                }
            ],
            
            listeners: {
                activate: function() {
                    Ext.Ajax.request({
                        url: this.url,
                        success: function(rs){
                            var infoPanel = this.getComponent('info_' + pane.slug);
                                infoPanel.update(rs.responseText);
                        },
                        scope: this
                    });
                },
            }
        });

        
        App.views.HtmlPage.superclass.initComponent.call(this);
    }
});

Ext.reg('htmlpage', App.views.HtmlPage);

