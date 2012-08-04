var FilterPage;

FilterPage = 
{
    build: function ()
    {
        // Setup filters
        FilterPage.Filters.element = $('#filter-form');
        FilterPage.Filters.getFilters(
            FilterPage.Filters.updateFilters
        );
        
        // Setup world search
        FilterPage.Search.getWorlds(FilterPage.Search.updateWorlds);
        
    },
    
    Views: {
    
    },
    
    Types: {
    
    },
    
    Filters:
    {
    },
    
    Search:
    {
    }
    
    
}


FilterPage.Filters = 
{

    element: null,
    
    type: {
        dropdown: 1,
        radio:    2
    },
    
    getFilters: function (callback)
    {
        $.get('/ajax/get-filters', {}, callback, 'json');
    },
    
    updateFilters: function (jsonData)
    {
        var view = null;
        for (var i = 0; i < jsonData.length; i++) {
            view = new View(FilterPage.Views.FilterView);
            view.setVars(jsonData[i]);        
            FilterPage.Filters.element.append(view.render());
        }
        
        $('.filter').change(function() {
            FilterPage.Search.getWorlds(
                FilterPage.Search.updateWorlds, $('#filter-form').serializeArray()
            );
        });
    }
}

FilterPage.Search =
{

    getWorlds: function (callback, requestParams)
    {
        if (!requestParams) {
            requestParams = {};
        }
        for (param in requestParams) {
            if (requestParams[param].value == 'notset') {
                delete requestParams[param];
            }
        }
	    $.post('/ajax/filter-worlds', requestParams, callback, 'json');
    },
    
    updateWorlds: function (jsonData)
    {
        //console.log('Updating worlds...');
        //console.log(jsonData);
        
        $('#world-container').empty();
        
        var view = null, worldHtml = null;
	    for (worldId in jsonData) {
	        view = new View(FilterPage.Views.WorldView);
            var filters = {};
	        for (filterName in jsonData[worldId]) {
	            var filterData = jsonData[worldId][filterName];
	            if (filterName == 'name') {
	                view.setVar('name', filterData);
	                continue;
	            }
	            filters[filterName] = filterData;
	        }
	        view.setVar('filters', filters);
	        worldHtml = view.render();
	        //console.log(worldHtml);
	        $('#world-container').append(worldHtml);
	    }
    }
    
}

FilterPage.Views =
{

    FilterView: function (filter)
    {
        var html = '<h5 class="filter">' + filter.title + '</h5>';
        
        if (!filter.type) {
            if (filter.options.length > 2) {
                filter.type = FilterPage.Filters.type.dropdown;
            } else {
                filter.type = FilterPage.Filters.type.radio;
            }
        }
        
        if (filter.type == FilterPage.Filters.type.dropdown) {
            html += '<option value="notset" selected>';
            html += 'No preference';
            html += '</option>';
            html += '<select class="filter" name="filter-' + filter.id + '">';
            for (optionId in filter.options) {
                var value = filter.options[optionId].value;
                html += '<option value="' + value + '">';
                html += filter.options[optionId].text;
                html += '</option>';
            }

            html += '</select>';
        }
        if (filter.type == FilterPage.Filters.type.radio) {
            html += '<input type="radio" class="filter" name="filter-' + filter.id + '" value="notset" checked> No preference<br>';
            for (optionId in filter.options) {
                var value = filter.options[optionId].value;
                html += '<input type="radio" class="filter" name="filter-' + filter.id + '" value="' + value + '"> ' + filter.options[optionId].text + '<br>';
            }
        }
        return html;
    },
    
    WorldView: function (vars)
    {
	    var worldHtml = '<div class="world"><h1>' + vars.name + '</h1><ul class="filters">';
	    for (filterName in vars.filters) {
	        var filterData = vars.filters[filterName];
	        worldHtml += '<li><span class="filter-name">' + filterName;
            worldHtml += ':</span> ' + filterData + '</li>';
	    }
	    worldHtml += '</ul></div>';
	    return worldHtml;
	}
    
}

FilterPage.Types =
{

    Filter: function (filter, options)
    {
        this.id      = null;
        this.filter  = filter;
        this.options = options;
        this.html    = null;
    },

    Option: function (answer, value)
    {
        this.text  = answer;
        this.value = value;
        this.id    = null;
        this.html  = null;
    }
    
}
