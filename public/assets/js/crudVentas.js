$(document).ready(function () {
    // MANEJA NAVEGACIÓN
    $('#content').on('click', '.nav-ventas', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('#content').html(response);
            },
            error: function () {
                $('#content').html('<p>Error al cargar la página.</p>');
            }
        });
    });

    // MANEJA LA BÚSQUEDA
    $('#content').on('input', '#buscar_venta', function (e) {
        e.preventDefault();
        const query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: '/DollarToyProyectoG3/ventas/buscar',
                method: 'GET',
                data: { query: query },
                success: function (response) {
                    $('table tbody').html(response);
                },
                error: function () {
                    console.log("error al buscar");
                }
            });
        };
    });



    // MANEJA ENVÍO DEL FORM
    $('#content').on('submit', '#ventaForm', function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: formData,
            success: function (response) {
                console.log("Respuesta del servidor:", response);
                try {
                    var res = JSON.parse(response);
                    alert(res.message);
                } catch (error) {
                    console.error("Error al parsear JSON:", error);
                    alert("Error al procesar la respuesta del servidor.");
                }
            },
            error: function () {
                alert("Error al guardar la venta.");
            }
        });
    });

    // Actualiza el subtotal en tiempo real
    $('#content').on('input', '#detallesBody .cantidad, #detallesBody .precio', function () {
        calcularSubtotal($(this).closest('.detalle'));
    });

    // CALCULAR SUBTOTAL
    function calcularSubtotal(detalle) {
        const cantidad = parseFloat(detalle.find('.cantidad').val()) || 0;
        const precio_unitario = parseFloat(detalle.find('.precio').val()) || 0;
        const sub_total = cantidad * precio_unitario;
        detalle.find('.sub-total').val(sub_total.toFixed(2));
        calcularTotal();
    }

    // CALCULAR TOTAL VENTA
    function calcularTotal() {
        let total = 0;
        $('input[name^="sub_total"]').each(function () {
            total += parseFloat($(this).val()) || 0;
        });
        $('#total').val(total.toFixed(2));
    }

    // Calcular subtotal inicial para cada detalle existente
    $('#detallesBody .detalle').each(function () {
        calcularSubtotal($(this));
    });



    // MANEJA BÚSQUEDA DE PRODUCTOS
    $('#content').on('input', '#buscar_producto', function () {
        const query = $(this).val();

        if (query.length > 2) { // Comienza a buscar después de 2 caracteres
            $.ajax({
                url: '/DollarToyProyectoG3/productos/buscar',
                method: 'GET',
                data: { query: query },
                success: function (response) {
                    const productos = JSON.parse(response);
                    if (productos.length > 0) {
                        const resultadosHtml = productos.map(producto => `
                            <div class="producto" data-id="${producto.id}" data-nombre="${producto.nombre}" data-precio="${producto.precio}">
                                <span>${producto.id}: ${producto.nombre} - S/.${producto.precio}</span>
                            </div>
                        `).join('');

                        $('#resultados_busqueda').html(resultadosHtml).show(); // Muestra los resultados
                    } else {
                        $('#resultados_busqueda').html('<div>No se encontraron productos.</div>').show();
                    }
                },
                error: function () {
                    $('#resultados_busqueda').html('<p>Error al buscar productos.</p>').show();
                }
            });
        } else {
            $('#resultados_busqueda').empty().hide(); // Limpia y oculta los resultados
        }
    });

    // MANEJA SELECCIÓN DE PRODUCTO
    $(document).on('click', '.producto', function () {
        const idProducto = $(this).data('id');
        const nombreProducto = $(this).data('nombre');
        const precioProducto = $(this).data('precio');

        // Añadir detalles al formulario
        $('#detallesBody').append(`
            <tr class="detalle">
                <td>
                    <input type="text" name="detalles[id_producto][]" value="${idProducto}" readonly class="form-control form-control-sm">
                </td>
                <td>
                    <input type="number" name="detalles[cantidad][]" required class="form-control form-control-sm cantidad">
                </td>
                <td>
                    <input type="number" name="detalles[precio_unitario][]" value="${precioProducto}" readonly class="form-control form-control-sm precio">
                </td>
                <td>
                    <input type="number" name="sub_total[]" readonly class="form-control form-control-sm sub-total">
                </td>
            </tr>
        `);

        $('#resultados_busqueda').empty().hide(); // Limpia y oculta los resultados
        calcularTotal(); // Actualiza el total
    });

    // Oculta el dropdown si se hace clic fuera
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#buscar_producto').length) {
            $('#resultados_busqueda').hide();
        }
    });


});