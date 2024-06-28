

const createDataTable = (options)=>{
    let {idTable,ajax,columns} = options;
    console.log(idTable,ajax,columns);
    let table = new DataTable(`#${idTable}`,{
        responsive:true,
        ajax: {
            url: ajax,
            dataSrc: ""
        },
        columns: columns,
        processing:true,
        language: {
            sProcessing: 'Procesando...', //Este es el mensaje que aparece en la tarjeta de carga de datos
            info: 'Mostrando pagina _PAGE_ of _PAGES_',
            infoEmpty: 'Datos no disponibles',
            infoFiltered: '(filtrado de un total de _MAX_ registros)',
            lengthMenu: 'Mostrar _MENU_ datos por pagina',
            zeroRecords: 'No encontrado  - losiento',
            sSearch: 'Buscar:',
            'paginate': {
                'next': 'Siguiente',
                'previous': 'Anterior'
            }
        },
        // autoWidth:true,
        
    })
    return table;
}



const reloadTable = (tabla)=>{
    tabla.ajax.reload();
}


export{
    createDataTable,
    reloadTable
}