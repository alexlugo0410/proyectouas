$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

$(document).on("click", ".edit", function () {
    const idUsuario = $(this).data("id");
    const nombre = $(this).data("nombre");
    const email = $(this).data("email");

    // Rellenar los campos del modal
    $("#editarUsuario input[name='nombre']").val(nombre);
    $("#editarUsuario input[name='email']").val(email);
    $("#editarUsuario").data("id", idUsuario); // Guardar el ID del usuario en el modal
});


// Editar Usuario
$("#editarUsuario form").on("submit", function (e) {
    e.preventDefault();
		var row = $(this).closest("tr");
		var id = row.find("td:eq(0)").text(); 
		var nombre = row.find("td:eq(1)").text();
		var email = row.find("td:eq(2)").text();
	
		$("#editarUsuario .id").val(id);
		$("#editarUsuario #nombre").val(nombre);
		$("#editarUsuario #email").val(email);

    $.ajax({
        url: "editar_usuario.php",
        type: "POST",
        data: { idUsuario, nombre, email},
        success: function (response) {
            const res = JSON.parse(response);
            if (res.status === "success") {
				alert(res.message);
				alert('Usuario actualizado exitosamente')
                location.reload();
            } else {
                alert(res.message);
            }
        },
    });
});

$(document).on("click", ".delete", function() {
    var row = $(this).closest("tr");
    var id = row.find("td:eq(0)").text(); // Asume que el ID está en la primera columna
    $("#eliminarUsuario .id").val(id);
});

// Eliminar Usuario

$("#eliminarUsuario form").on("submit", function (e) {

	e.preventDefault();
	
	var row = $(this).closest("tr");
	var id = row.find("td:eq(0)").text(); 
	

	$("#eliminarUsuario .id").val(id);


    $.ajax({
        url: "eliminar_usuario.php",
        type: "POST",
        data: { id },
        success: function (response) {
            const res = JSON.parse(response);
            if (res.status === "success") {
                alert(res.message);
                location.reload();
            } else {
                alert(res.message);
            }
        },
    });
});