function FilterView(vars)
{
    var html = '<h5 class="filter">' + vars.title + '</h5><select>';
    for (optionId in vars.options) {
        var id = 'option-' + Math.floor(Math.random()*5000),
            value = vars.options[optionId].value;
        html += '<option id="' + id + '" value="' + value + '">';
        html += vars.options[optionId].text;
        html += '</option>';
    }
    html += '</select>';
    return html;
}

var filters = [
    new Filter(
        'With or without paladin?',
        [new Option('With paladin', 1), new Option('Without paladin', 0)]
    ),
    new Filter(
        'Nobel item',
        [new Option('Packages', 1), new Option('Coins', 2)]
    ),
    new Filter(
        'With or without church?',
        [new Option('With church', 1), new Option('Without church', 0)]
    ),
    new Filter(
        'Speed',
        [new Option('1', 1), new Option('2', 2), new Option('3', 3)]
    )
];

function Filter(filter, options) {
    this.id      = null;
    this.filter  = filter;
    this.options = options;
    this.html    = null;
};

function Option(answer, value) {
    this.text  = answer;
    this.value = value;
    this.id    = null;
    this.html  = null;
};

function build() {
    var view = null;
    for (var i = 0; i < filters.length; i++) {
        view = new View(FilterView);
        view.setVar('title', filters[i].filter);        
        view.setVar('options', filters[i].options);
        $('#filters').append(view.render());
    }
}

$().ready(function () {
    build();
    $('#build').click(build);
    $('#clean').click(function () {
        $('#filters').empty();
    });
});
