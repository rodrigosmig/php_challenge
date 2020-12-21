$(function() {
    var countPerson = 0;
    var countShipOrder = 0;

    $('#btn_person').on('click', function(event) {
        event.preventDefault()

        var files = $('#person-file')[0].files;

        if(files.length > 0 ) {
            var log_list = $('#person-log_list');
            var formData = new FormData();

            log_list.append(getList(++countPerson, 'person'));
            formData.append('file', files[0]);
            formData.append('_token', $("input[name*='_token']").val());
        
            $.ajax({
                url: '/upload-person',
                type: 'post',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response){
                    setSucess(countPerson, response.message, 'Success', 'person')
                },
                error: function (request, error) {
                    setSucess(countPerson, request.responseJSON.message, 'Error', 'person')
                }
            });

        } else {
           alert("Please select a file.");
        }
    })

    $('#btn_ship_order').on('click', function(event) {
        event.preventDefault()

        var files = $('#ship_order-file')[0].files;

        if(files.length > 0 ) {
            var log_list = $('#ship_order-log_list');
            var formData = new FormData();

            log_list.append(getList(++countShipOrder, 'ship_order'));
            formData.append('file', files[0]);
            formData.append('_token', $("input[name*='_token']").val());
        
            $.ajax({
                url: '/upload-shiporder',
                type: 'post',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response){
                    setSucess(countShipOrder, response.message, 'Success', 'ship_order')
                },
                error: function (request, error) {
                    setSucess(countShipOrder, request.responseJSON.message, 'Error', 'ship_order')
                }
            });

        } else {
           alert("Please select a file.");
        }
    })

    function getLoading() {
        return "<div class='spinner-border' style='width: 1.5rem; height: 1.5rem' role='status'> \
            <span class='sr-only'>Loading...</span> \
        </div>";
    }

    function getList(id, type) {
        return "<li id='" + type + "-log-" + id + "'>" + getLoading() + "</li>"
    }

    function setSucess(id, message, status, type) {
        var color = status == 'Error' ? 'red' : 'green'
        var li = $('#' + type + '-log-' + id);
        li.css('color', color);
        li.html(status + ' - ' + message);
    }
})