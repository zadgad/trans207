const formularios_ajax = document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e){
	e.preventDefault();

	let data = new FormData(this);
	let method = this.getAttribute("method");
	let action = this.getAttribute("action");
	let tipo = this.getAttribute("data-form");

	let encabezados = new Headers();

	let config = {
		method: method,
		headers: encabezados,
		mode: 'cors',
		cache: 'no-cache',
		body: data
	}

	let texto_alerta;

	if(tipo==="save"){
		texto_alerta="Los datos quedaran guardados en el sistema";
	}else if(tipo==="delete"){
		texto_alerta="Los datos serán eliminados completamente del sistema";
	}else if(tipo==="update"){
		texto_alerta="Los datos del sistema serán actualizados";
	}else if(tipo==="search"){
		texto_alerta="Se eliminará el término de búsqueda y tendrás que escribir uno nuevo";
	}else if(tipo==="loans"){
		texto_alerta="Desea remover los datos seleccionados para préstamos o reservaciones";
	}else{
		texto_alerta="Quieres realizar la operación solicitada";
	}

	Swal.fire({
		title: '¿Estás seguro?',
		text: texto_alerta,
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar',
		cancelButtonText: 'Cancelar'
	}).then((result) => {
		if(result.value){
			fetch(action,config)
			.then(respuesta => respuesta.json())
			.then(respuesta => {
				return alertas_ajax(respuesta);
			});
		}
	});

}

formularios_ajax.forEach(formularios => {
	formularios.addEventListener("submit", enviar_formulario_ajax);
});

function alertas_ajax(alerta){
	if(alerta.Alerta==="simple"){
		Swal.fire({
			title: alerta.Titulo,
			text: alerta.Texto,
			type: alerta.Tipo,
			confirmButtonText: 'Aceptar'
		});
	}else if(alerta.Alerta==="recargar"){
		Swal.fire({
			title: alerta.Titulo,
			text: alerta.Texto,
			type: alerta.Tipo,
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if(result.value){
				location.reload();
			}
		});
	}else if(alerta.Alerta==="limpiar"){
		Swal.fire({
			title: alerta.Titulo,
			text: alerta.Texto,
			type: alerta.Tipo,
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if(result.value){
				document.querySelector(".FormularioAjax").reset();
			}
		});
	}else if(alerta.Alerta==="redireccionar"){
		window.location.href=alerta.URL;
	}
}

/*btn ayuda*/

	let btn_ayud=document.querySelector(".btn-ayuda");
	btn_ayud.addEventListener('click', function(e){
		e.preventDefault();
		Swal.fire({
		  title: '<strong><i class="fas fa-user"></i>Desarrollador</strong>',
		  type:'info',
		  icon: 'info',

		  html:

		    '<h5>Redes sociales </h5> ' +
		    '<a href="https://web.facebook.com/profile.php?id=100007338885245"><i class="fab fa-facebook">&nbsp;&nbsp;Facebook</i></a>&nbsp; ' +
		    '<a href=""><i class="fab fa-whatsapp">&nbsp;Whatsapp</i></a>&nbsp;&nbsp;'+
		    '<a href=""><i class="fab fa-youtube">Youtube</i>  </a>',
		  showCloseButton: true,
		  confirmButtonText:
		    '<i class="fa fa-thumbs-up"></i> Like!'

		 
})
	});


	$(document).on("click", ".vehiculoCliente", function () {
		var ids = $(this).data('id');
     $(".modal-body #cliente_add").val( ids );
	});
	
	    function generate() {
      var doc = new jsPDF('p', 'pt', 'a4');
    doc.text(100, 20, "TRANSPORTE");
    doc.setFont("Times New Roman");
    doc.setFontSize(12);
    doc.text(100, 30, "Cochabamba:");
    doc.text(200, 30,'Transporte');
    doc.setTextColor(0, 0, 0);
	doc.text(100, 40, "Fercha:");
	var fecha = new Date();
    doc.text(200, 40, fecha.toLocaleString(undefined, {year: 'numeric', month: '2-digit', day: '2-digit', weekday:"long", hour: '2-digit', hour12: false, minute:'2-digit', second:'2-digit'}));
    doc.setTextColor(0, 0, 0);
    doc.text(100, 50, "Emetido por:");
    doc.text(200, 50,'Administrador');
    doc.setTextColor(0, 0, 0);
    doc.text(300, 60, "ADMINISTRADOR:" + " " + 'TRANSPORTE');
    doc.text(300, 70, "PAGOS:" + " " + '');
    doc.text(300, 80, "VENTAS:" + " " + '');
			var elem = document.getElementById('example');
			var fila=elem.getElementsByTagName('tr');
			var ultimaColumna = fila.length - 1;
			
			var k = 0;
			var element2 = fila[0].getElementsByTagName('th'), index2;
			for (index2 = element2.length - 1; index2 >= 0; index2--) {
					if (k<2) {
						element2[index2].style.display = 'none';
					}
					k++;
				}
			for(var i=0;i<=ultimaColumna;i++){
				var element = fila[i].getElementsByTagName('td'), index;
				
				var h = 0;
				for (index = element.length - 1; index >= 0; index--) {
					if (h<2) {
						element[index].style.display = 'none';
					}
					h++;
					//element[index].parentNode.removeChild(element[index]);
				}
				
			}
	  var data = doc.autoTableHtmlToJson(elem);
      doc.autoTable(data.columns, data.rows, {
                tableLineColor: [189, 195, 199],
        tableLineWidth: 0.75,
        styles: {
            font: 'Meta',
            lineColor: [44, 62, 80],
            lineWidth: 0.55
        },
        headerStyles: {
            fillColor: [0, 0, 0],
            fontSize: 9
        },
        bodyStyles: {
            fillColor: [216, 216, 216],
            textColor: 50
        },
        alternateRowStyles: {
            fillColor: [250, 250, 250]
        },
		 startY: 100,
		//startY: doc.lastAutoTable.finalY + 25,
        didDrawPage: function (data) {
            var pageSize = doc.internal.pageSize
          // Header
            doc.setFontSize(14)
            doc.setTextColor(40)
            doc.setFontStyle("bold")
            doc.text(title, (doc.internal.pageSize.getWidth()/2)-half_width, 22)
            doc.setFontSize(10)
            doc.setTextColor(150);
            doc.setFontStyle("nomal")
            doc.text(date, (doc.internal.pageSize.getWidth()/2)-42, 33)

              // Footer
            var str = "Page " + doc.internal.getNumberOfPages()
              // Total page number plugin only available in jspdf v1.0+
            if (typeof doc.putTotalPages === "function") {
                str = str + " of " + totalPagesExp
            }
            doc.setFontSize(10)
            doc.setTextColor(150);
              // jsPDF 1.4+ uses getWidth, <1.4 uses .width
            var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight()
              doc.text(str, 40, pageHeight - 10)
        },
     drawRow: (row, data) => {
        //-------------------------------
        // Paint double lines bellow cell
        //-------------------------------
        let firstCell = row.cells[0];
        let secondCell = row.cells[1];
        if (firstCell.text == 'Total due anually') {
          let borderLineOffset = 1;
          const columnWidth = data.table.columns[3].width;
          data.doc.line(data.cursor.x - columnWidth, data.cursor.y + row.height - borderLineOffset / 2, data.cursor.x, data.cursor.y + row.height - borderLineOffset / 2);
          data.doc.line(data.cursor.x - columnWidth, data.cursor.y + row.height + borderLineOffset / 2, data.cursor.x, data.cursor.y + row.height + borderLineOffset / 2);
        }
        //-------------------------------
        // Paint double lines bellow cell
        //-------------------------------
        if (secondCell.text == 'Totally sales Tax') {
          data.doc.line(data.cursor.x - data.table.width, data.cursor.y + row.height, data.cursor.x, data.cursor.y + row.height);
          data.doc.line(data.cursor.x - data.table.width, data.cursor.y + row.height, data.cursor.x, data.cursor.y + row.height);
        }
      },
      drawHeaderRow: (head, data) => {
        //---------------------------------------
        // Write the line at the bottom of header
        //---------------------------------------
        data.doc.line(data.cursor.x, data.cursor.y + head.height, data.cursor.x + data.table.width, data.cursor.y + head.height);
		  },
	  createdCell: function(cell, data) {
                var tdElement = cell.raw;
                if (tdElement.classList.contains('notprint')) {
                    cell.text = 'erum'
                }
                if (typeof cell.raw === 'undefined')
                {

                    cell.raw.text = "erum";
                }
		  },
	  drawCell: function(cell, data) {
            if (data.table.rows.length  === 0 || data.table.rows.length - 1) {
              cell.styles.setFontStyle = "bold";
            }
          },
	  showFoot: "lastPage",
    }); 
			doc.save("table.pdf");
			location.reload();
    }

$('#export').click(function (e) {
	e.preventDefault();   
    generate();
});