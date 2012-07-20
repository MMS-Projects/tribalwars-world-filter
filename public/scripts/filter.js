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
    for (var i = 0; i < filters.length; i++) {
        filters[i].id = 'filter-' + Math.floor(Math.random()*5000);
        filters[i].html = $('<div/>', {
            id: filters[i].id,
            title: filters[i].filter,
            html: '<h5>' + filters[i].filter + '</h5>',
            class: 'filter'
        });
        var select = $('<select/>', {id: filters[i].id + '-select'});
        select.change(function () {
            var item;
            $('#' + this.id + ' option:selected').each(function () {
                item = $(this).val();
            });
            console.log('select ' + item);
        });
        for (var optionId = 0; optionId < filters[i].options.length; optionId++) {
            filters[i].options[optionId].html = $('<option/>', {
                value: filters[i].options[optionId].value,
                text: filters[i].options[optionId].text
            });
            select.append(filters[i].options[optionId].html);
            filters[i].options[optionId].id = 'option-' + Math.floor(Math.random()*5000);
        }
        console.log(select);
        select.appendTo(filters[i].html);
        filters[i].html.appendTo($('#filters'));
    }
}

$().ready(function () {
    build();
    $('#build').click(build);
    $('#clean').click(function () {
        $('#filters').empty();
    });
});
