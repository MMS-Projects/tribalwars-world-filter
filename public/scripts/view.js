function View(view, variables) 
{
    this.initialize(view, variables);
    return this;
}

View.prototype = 
{
    
    initialize: function (view, variables) {
        if (variables) {
            this._variables = variables;
        } else {
            this._variables = {};
        }
        this.view       = view;
    },
    
    setVar: function (name, value) {
        this._variables[name] = value;
    },
    
    setVars: function (variables) {
        this._variables = variables;
    },
    
    render: function () {
        var data = this.view(this._variables);
        return data;
    }
        
}
