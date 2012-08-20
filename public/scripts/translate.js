function Translate(strings) 
{
    this.initialize(strings);
    return this;
}

Translate.prototype = 
{
    
    initialize: function (strings) {
        if (strings) {
            this._strings = strings;
        } else {
            this._strings = {};
        }
    },
    
    addText: function (string) {
        this._strings[string] = string;
    },
    
    setTexts: function (variables) {
        this._strings = strings;
    },
    
    translate: function (callback) {
        var params = {
            strings: this._strings
        };
        if (!callback) {
            callback = this.updateStrings;
        }
        $.post('/ajax/get-translations/', params, callback, 'json');
    },
    
    updateStrings: function (jsonData) {
        console.log(jsonData);
        this._strings = jsonData;
    },
    
    getTranslation: function (string) {
        var data = this._strings[string];
        return data;
    }
        
}
