var cont = 0;
var total = 0;
var detalleventa = [];
var subtotal = [];
var controlproducto = [];
let venta = {
    detallesventa: []
};

$(document).ready(function () {
    $('#cliente_id').change(function () {
        mostrarCliente();
    });
    $('#idproducto').change(function () {
        mostrarProducto();
    });
    $('#btnadddet').click(function () {
        agregarDetalle();
    });
    $('#btnRegistrar').click(function(event) {
        event.preventDefault();
        addVenta();
        saveData(venta);
    });
});

function mostrarCliente() {
    var datosCliente = $('#cliente_id').val().split('_');
    $('#ruc').val(datosCliente[1]);
    $('#direccion').val(datosCliente[2]);
}

function mostrarProducto() {
    var idproducto = $("#idproducto").val();
    $.get('/EncontrarProducto/' + idproducto, function (data) {
        $('input[name=idproducto]').val(data[0].idproducto);
        $('input[name=talla]').val(data[0].talla);
        $('input[name=precio]').val(data[0].precio);
        $('input[name=stock]').val(data[0].cantidad);
    });
}

function mostrarTipo() {
    var tipo_id = $("#seltipo").val();
    $.get('/EncontrarTipo/' + tipo_id, function (data) {
        $('input[name=nrodoc]').val(data[0].serie + '' + data[0].numeracion);
    });
}

function mostrarMensajeError(mensaje) {
    $(".alert").css('display', 'block')
        .removeClass("hidden")
        .addClass("alert-danger")
        .html("<button type='button' class='close' dataclose='alert'>×</button>" + "<span><b>Error!</b> " + mensaje + ".</span>")
        .delay(5000).hide(400);
}

function agregarDetalle() {
    var ruc = $("#ruc").val();
    if (ruc === '') {
        mostrarMensajeError("Por favor seleccione el Cliente");
        return false;
    }

    var descripcion = $('#idproducto option:selected').text();
    if (descripcion === '- Seleccione Producto -') {
        mostrarMensajeError("Por favor seleccione el Producto");
        return false;
    }

    var cantidad = parseFloat($("#cantidad").val());
    var stock = parseFloat($("#stock").val());
    if (isNaN(cantidad) || cantidad <= 0 || cantidad > stock) {
        mostrarMensajeError("Por favor ingrese una cantidad válida");
        return false;
    }

    var pventa = $("#precio").val();
    if (isNaN(pventa) || pventa <= 0) {
        mostrarMensajeError("Por favor ingrese un precio de venta válido");
        return false;
    }

    var cod_producto = $("#idproducto").val();

    // Simplify the code for checking if the product code already exists
    if (controlproducto.includes(cod_producto)) {
        mostrarMensajeError("No puede volver a vender el mismo producto");
        return false;
    } else {
        var talla = $("#talla").val();
        subtotal[cont] = cantidad * pventa;
        controlproducto[cont] = cod_producto;
        total += subtotal[cont];

        // Use template literals for better string formatting
        var fila = `<tr class="selected" id="fila${cont}">
                        <td style="text-align:center;">
                            <button type="button" class="btn btn-danger btn-xs" onclick="eliminardetalle(${cod_producto},${cont});">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                        <td style="text-align:right;">
                            <input type="text" name="cod_producto[]" value="${cod_producto}" readonly style="width:50px; text-align:right;">
                        </td>
                        <td>${descripcion}</td>
                        <td><input type="text" name="talla[]" value="${talla}" style="width:140px; text-align:left;"></td>
                        <td style="text-align:right;">
                            <input type="number" name="cantidad[]" value="${cantidad}" style="width:80px; text-align:right;" readonly>
                        </td>
                        <td style="text-align:right;">
                            <input type="number" name="pventa[]" value="${pventa}" style="width:80px; text-align:right;" readonly>
                        </td>
                        <td style="text-align:right;">${number_format(subtotal[cont], 2)}</td>
                    </tr>`;

        $('#detalles').append(fila);

        detalleventa.push({
            codigo: cod_producto,
            talla: talla,
            cantidad: cantidad,
            pventa: pventa,
            subtotal: subtotal[cont]
        });

        cont++;
    }

    $('#total').val(number_format(total, 2));
    limpiar();
}

function limpiar() {
    $("#cantidad").val('1');
    $("#producto_id").val("0").change();
    $("#talla").val('');
    $("#precio").val('');
    $("#stock").val('');
}

function eliminardetalle(codigo, index) {
    total -= subtotal[index];
    var tam = detalleventa.length;
    var pos;
    for (var i = 0; i < tam; i++) {
        if (detalleventa[i].codigo == codigo) {
            pos = i;
            break;
        }
    }
    detalleventa.splice(pos, 1);
    $('#fila' + index).remove();
    controlproducto[index] = "";
    $('#total').val(number_format(total, 2));
}

function number_format(amount, decimals) {
    amount += ''; // Convert to string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // Remove non-numeric characters
    decimals = decimals || 0;

    if (isNaN(amount) || amount === 0) {
        return parseFloat(0).toFixed(decimals);
    }

    amount = '' + amount.toFixed(decimals);
    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0])) {
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');
    }

    return amount_parts.join('.');
}

function addVenta() {
    venta = {
        ruc: $("#ruc").val(),
        seltipo: $("#seltipo").val(),
        nrodoc: $("#nrodoc").val(),
        fecha: $("#fecha").val(),
        total: total,
        detallesventa: []
    };

    for (let i = 0; i < detalleventa.length; i++) {
        venta.detallesventa.push({
            idproducto: detalleventa[i].codigo,
            cantidad: detalleventa[i].cantidad,
            precio: detalleventa[i].pventa
        });
    }

    console.log(JSON.stringify(venta));

}
function saveData(venta) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'http://127.0.0.1:8000/ventas',
        method: 'POST',
        data: JSON.stringify(venta),  // Enviar como JSON
        contentType: 'application/json',  // Definir el tipo de contenido como JSON
        success: function(response) {
            if (response.success) {
                alert(response.message);  // Muestra el mensaje de éxito
                window.location.href = '/ventas';  // Redirigir al listado de ventas
            } else {
                alert(response.message);  // Muestra el mensaje de error
            }
        },
        error: function(error) {
            alert('Hubo un error al guardar el registro: ' + error);
        }
    });
}

