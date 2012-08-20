var FilterPage;

FilterPage = 
{
    build: function ()
    {
        // Setup filters
        FilterPage.Filters.element = $('#filter-form');
        FilterPage.Filters.getFilters(function (jsonData) {
            FilterPage.Filters.updateFilters(jsonData);
            
            // Setup world search
            FilterPage.Search.getWorlds(FilterPage.Search.updateWorlds);
        });
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
    
    filters: {},
    
    getFilters: function (callback)
    {
        console.log('Getting filters');
        $.get('/ajax/get-filters', {}, callback, 'json');
    },
    
    updateFilters: function (jsonData)
    {
        console.log('Saving filters in memory');
        var view = null;
        for (var i = 0; i < jsonData.length; i++) {
            view = new View(FilterPage.Views.FilterView);
            view.setVars(jsonData[i]);        
            FilterPage.Filters.element.append(view.render());
            FilterPage.Filters.filters[jsonData[i].tag] = jsonData[i];
        }
        
        $('.filter').change(function() {
            FilterPage.Search.getWorlds(
                FilterPage.Search.updateWorlds, $('#filter-form').serializeArray()
            );
        });
    },
    getValueName: function (tag, value) {
        var filter = FilterPage.Filters.filters[tag];
        for (optionId in filter.options) {
            var option = filter.options[optionId];
            if (option.value == value) {
                return option.text;
            }
        }
        return value;
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
        $('#world-container').empty();
        
        var view = null, worldHtml = null;
	    for (worldId in jsonData) {
	        view = new View(FilterPage.Views.WorldView);
            var filters = {};
	        for (tag in jsonData[worldId]) {
	            if (tag == 'tag') {
	                view.setVar('tag', jsonData[worldId][tag]);
	                continue;
	            }
	            if (!FilterPage.Filters.filters[tag]) {
	                continue;
	            }
	            var filterData = {
	                tag: tag,
	                title: FilterPage.Filters.filters[tag].title,
	                value: jsonData[worldId][tag],
	                valueText: FilterPage.Filters.getValueName(
	                    tag, jsonData[worldId][tag]
                    )
	            };
	            /*var filterData = jsonData[worldId][filterName];
	            //console.log(FilterPage.Filters.filters);
	            console.log(FilterPage.Filters.filters[filterName]);
	            if (FilterPage.Filters.filters[filterName]) {
	                filterName = FilterPage.Filters.filters[filterName].title;
	            }
	            if (filterName == 'tag') {
	                view.setVar('tag', filterData);
	                continue;
	            }*/
	            filters[tag] = filterData;
	        }
	        view.setVar('filters', filters);
	        worldHtml = view.render();
	        $('#world-container').append(worldHtml);
	    }
	    $('.show-details').click(function (e) {
	        var detailsRow = ((e.target.parentNode.rowIndex + 1) / 2) - 1;
	        $('.world-details').eq(detailsRow).toggle('fast');
	        $('#content').scrollTo($('.world').eq(detailsRow));
	    });
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
            html += '<select class="filter" name="filter-' + filter.tag + '">';
            html += '<option value="notset" selected>No preference</options>';
            for (optionId in filter.options) {
                var value = filter.options[optionId].value;
                html += '<option value="' + value + '">';
                html += filter.options[optionId].text;
                html += '</option>';
            }
            html += '</select>';
        }
        if (filter.type == FilterPage.Filters.type.radio) {
            html += '<input type="radio" class="filter" name="filter-' + filter.tag + '" value="notset" checked> No preference<br>';
            for (optionId in filter.options) {
                var value = filter.options[optionId].value;
                html += '<input type="radio" class="filter" name="filter-' + filter.tag + '" value="' + value + '"> ' + filter.options[optionId].text + '<br>';
            }
        }
        return html;
    },
    
    WorldView: function (vars)
    {
        var worldHtml = '<tr class="even world"><td class="first compare">Check</td><td class="thumb">Picture</td><td class="title ellipsis">';
	    worldHtml += '<p>' + vars.tag + '</p>';
	    var subtitle = '';
	    var i = 1;
	    for (tag in vars.filters) {
	        var filter = vars.filters[tag];
	        subtitle += filter.title + ': ' + filter.valueText;
	        if (i == 3) {
	            break;
	        } else {
	            subtitle += ' - ';
	        }
	        ++i;
	    }
	    worldHtml += '<p class="subtitle"> ' + subtitle + '.</p>';
	    worldHtml += '</td>'
	    i = 1;
	    for (tag in vars.filters) {
	        var filterData = FilterPage.Filters.getValueName(
	            tag, vars.filters[tag].value
            );
	        worldHtml += '<td class="spec" title="' + filterData + '">' + filterData + '</td>';
	        if (i == 2) {
	            break;
	        } else {
	            subtitle += ' - ';
	        }
	        ++i;
	    }
	    worldHtml += '<td class="players"><p>1.000.000</p><p class="subtitle">80.000</p></td><td class="show-details last"></td></tr>';
	    worldHtml += '<tr class="even world-details"><td colspan="7">';
	    for (tag in vars.filters) {
	        var filter = vars.filters[tag];
	        worldHtml += '<li><span class="filter-name">' + filter.title;
            worldHtml += ':</span> ' + filter.valueText + '</li>';
	    }
	    worldHtml += '</td></tr>';
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
