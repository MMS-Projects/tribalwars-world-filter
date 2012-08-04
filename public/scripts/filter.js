var FilterPage;

FilterPage = 
{
    build: function ()
    {
        // Setup filters
        var filters = FilterPage.Filters.getFilters();
        FilterPage.Filters.updateFilters($('#filter-form'), filters);
        $('.filter').change(function() {
            FilterPage.Search.getWorlds(
                FilterPage.Search.updateWorlds, $('#filter-form').serialize()
            );
        });
        
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

    getFilters: function ()
    {
        return [
            new FilterPage.Types.Filter(
                'With or without paladin?',
                [new Option('With paladin', 1), new Option('Without paladin', 0)]
            ),
            new FilterPage.Types.Filter(
                'Nobel item',
                [new Option('Packages', 1), new Option('Coins', 2)]
            ),
            new FilterPage.Types.Filter(
                'With or without church?',
                [new Option('With church', 1), new Option('Without church', 0)]
            ),
            new FilterPage.Types.Filter(
                'Speed',
                [new Option('1', 1), new Option('2', 2), new Option('3', 3)]
            )
        ];
    },
    
    updateFilters: function (element, filters)
    {
        var view = null;
        for (var i = 0; i < filters.length; i++) {
            filters[i].id = i;
            view = new View(FilterPage.Views.FilterView);
            view.setVars(filters[i]);        
            $('#filter-form').append(view.render());
        }
    }
}

FilterPage.Search =
{

    getWorlds: function (callback, requestParams)
    {
        if (!requestParams) {
            requestParams = {};
        }
        console.log(requestParams)	    
	    $.post('/ajax/filter-worlds', requestParams, callback, 'json');
    },
    
    updateWorlds: function (jsonData)
    {
        console.log('Updating worlds...');
        console.log(jsonData);
        
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

    FilterView: function (vars)
    {
        var html = '<h5 class="filter">' + vars.filter + '</h5><select class="filter" name="filter-' + vars.id + '">';
        for (optionId in vars.options) {
            var id = 'option-' + Math.floor(Math.random()*5000),
                value = vars.options[optionId].value;
            html += '<option id="' + id + '" value="' + value + '">';
            html += vars.options[optionId].text;
            html += '</option>';
        }
        html += '</select>';
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
