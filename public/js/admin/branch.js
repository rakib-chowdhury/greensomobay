$(document).ready(function () {
    $('#division').selectize().on('change', function(){
        var value = $(this).val();
        var show = $('#district');
        show.html('looading');
        var options = [];
        $.get('/district/'+ value).done(function (data) {
            $.each(data, function () {
                options.push({
                    id: this.id,
                    title: this.bn_name
                });
            });
            show.selectize({
                maxOptions: 100,
                valueField: 'id',
                labelField: 'title',
                searchField: 'title',
                sortField: 'title',
                options: options,
                create: true
            });
        })
    });
    $('#district').selectize().on('change', function(){
        var value = $(this).val();
        var show = $('#subDistrict');
        var result = '';
        show.html('looading');
        var options = [];
        $.get('/sub_district/'+ value).done(function (data) {
            $.each(data, function () {
                options.push({
                    id: this.id,
                    title: this.bn_name
                });
            });
            show.selectize({
                maxOptions: 100,
                valueField: 'id',
                labelField: 'title',
                searchField: 'title',
                sortField: 'title',
                options: options,
                create: true
            });
        })
    });
});