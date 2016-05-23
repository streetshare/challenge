$(document).on('ready', ready);

function ready() {
    $("input[data-validate=numbers]").onlyDigits();
    $('#btn_reset').on('click', reset);
    $('#btn_send').on('click', validate_intents);
    $('body').on('click', '.btn_process_tam', process_tam);
    $('body').on('click', '.btn_operation', validate_operation);
}

function validate_intents() {
    var intents = $('#input_intents').val();
    if (intents.length == 0) {
        alert('Por favor ingrese el número de intentos');
        return false;
    }
    if (intents < 1 || intents > 50) {
        alert('Por favor ingresa un número entre 1 y 50');
        return false;
    }
    $('#content_general').html('');
    var html = $('#example').html();
    for (var i = 1; i <= intents; i++) {
        html_append = html.replace(/#/g, i);
        $('#content_general').append(html_append);
    }
    var callData = JSON.stringify({
        "serviceName": "service",
        "methodName": "set_intents",
        "parameters": [intents]
    });
    $.post(SERVICE, callData, function(data) {
    });
}

function validate_operation() {
    var $element = $(this);
    var intent = $element.parents('.content_intent').attr('data-id');
    var operation = $element.parent().find('.input_operation').val();
    var count = $element.parent().find('.count').html();
    if (count > 0) {
        operation = operation.toUpperCase();
        var array = operation.split(' ');
        if (array[0] == 'CONSULTAR') {
            if (array.length == 7) {
                var callData = JSON.stringify({
                    "serviceName": "service",
                    "methodName": "get_data",
                    "parameters": [intent, array[1], array[2], array[3], array[4], array[5], array[6]]
                });
                $.post(SERVICE, callData, function(data) {
                    var resp = $.parseJSON(data);
                    var $content = $element.parent().parent().find('.content_aswer');
                    $content.append(resp.data + '<br>');
                    $element.parent().find('.count').html(count - 1);
                    $element.parent().find('.input_operation').val('');
                });
            } else {
                alert('Error al consultar, intenta: CONSULTAR x1 y1 z1 x2 y2 z2');
                return false;
            }
        } else if (array[0] == 'ACTUALIZAR') {
            if (array.length == 5) {
                var callData = JSON.stringify({
                    "serviceName": "service",
                    "methodName": "validate_set_data",
                    "parameters": [intent, array[1], array[2], array[3], array[4]]
                });
                $.post(SERVICE, callData, function(data) {
                    var resp = $.parseJSON(data);
                    var $content = $element.parent().parent().find('.content_aswer');
                    $content.append(resp.data + '<br>');
                    $element.parent().find('.count').html(count - 1);
                    $element.parent().find('.input_operation').val('');
                });
            } else {
                alert('Error al actualizar, intenta: ACTUALIZAR x y z w');
                return false;
            }
        } else {
            alert('Operación no válida');
            return false;
        }
    } else {
        alert('No puedes realizar más operaciones');
        return false;
    }
}

function process_tam() {
    var $element = $(this);
    var intent = $element.parents('.content_intent').attr('data-id');
    var string = $element.parent().find('.input_tam').val();
    string = $.trim(string);
    $element.parent().parent().find('.content_aswer').html('');
    if (string.length == 0) {
        alert('Por favor ingrese el tamaño de la matriz');
        return false;
    }
    var array = string.split(' ');
    if (array.length != 2) {
        alert('La estructura no coincide, intente nuevamente. N M')
        return false;
    }
    var callData = JSON.stringify({
        "serviceName": "service",
        "methodName": "set_new_matriz",
        "parameters": [intent, array[0], array[1]]
    });
    $.post(SERVICE, callData, function(data) {
        console.log(data);
        var $content = $element.parent().parent().find('.content_aswer');
        $content.append('Matriz de tamaño ' + array[0] + '*' + array[0] + '*' + array[0] + ' creada.<br>');
        $element.parent().find('.count').html(array[1]);
    });
}

function process_operation() {

}

function reset() {
    $('#input_intents').val('');
    $('#content_general').html('');
    var callData = JSON.stringify({
        "serviceName": "service",
        "methodName": "destroy_session",
        "parameters": []
    });
    $.post(SERVICE, callData, function(data) {
    });
}

//Plugin de jQuery para permitir solo numeros o digitos en un input
(function($) {
    $.fn.onlyDigits = function() {
        return this.each(function() {
            $(this).keypress(function(e) {
                if (e.which != 32 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });
        });
    };
}(jQuery));