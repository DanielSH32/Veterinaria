//Variables globales y selecctores
const btnNew=document.querySelector("#btnAgregar");
const btnCancelar=document.querySelector("#btnCancelar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const formCompra=document.querySelector("#formCompra");
const formProducto=document.querySelector("#formProducto");
const divFoto=document.querySelector("#divFoto");
const inputFoto=document.querySelector("#foto");
const tableContent=document.querySelector("#contentTable table tbody");
const pagination=document.querySelector(".pagination");
const searchText=document.querySelector("#txtSearch");
const API=new Api();
const objDatos={
    records:[],
    recordsFilter:[],
    currentPage:1,
    recordsShow:5,
    filter:""
};
//Configuracion de eventos

eventListiners();

function eventListiners() {
    btnNew.addEventListener("click",agregarCompra);
    btnCancelar.addEventListener("click",cancelarCompra);
    document.addEventListener("DOMContentLoaded",cargarDatos);
    searchText.addEventListener("input", aplicarFiltro);
    divFoto.addEventListener("click", agregarFoto);
    inputFoto.addEventListener("change", actualizarFoto);
    formCompra.addEventListener("submit",guardarCompra);
    formProducto.addEventListener("submit",guardarProducto);
}

//Funciones

function guardarCompra(event){
    event.preventDefault();
    const formData=new FormData(formCompra);
    API.post(formData,"compras/save").then(
        data=>{
            if (data.success) {
                cancelarCompra();
                Swal.fire({
                    icon:"info",
                    text:data.msg
                });
            }else{
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:data.msg
                })
            }
        }
    ).catch(
        error=>{
            Console.log("Error", error);
        }
    );
}

function guardarProducto(event){
    event.preventDefault();
    const formData2=new FormData(formProducto);
    API.post(formData2,"compras/saveProducto").then(
        data=>{
            if (data.success) {
                cancelarCompra();
                Swal.fire({
                    icon:"info",
                    text:data.msg
                });
            }else{
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:data.msg
                })
            }
        }
    ).catch(
        error=>{
            Console.log("Error", error);
        }
    );
}

function agregarFoto(){
    inputFoto.click();
}

function actualizarFoto(el){
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            console.log(e.target.result);
            divFoto.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}

function cargarDatos() {
    API.get("compras/getAll").then(
        data=>{
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
                cargarProveedores();
            } else {
                console.log("Error al recuperar registros");
            }
        }
    ).catch(
        error=>{
            console.error("Error en la llamada:",error);
        }
    )
}

function aplicarFiltro(element){
    element.preventDefault();
    objDatos.filter=this.value;
    crearTabla();
}

function cargarProveedores() {
    API.get("proveedores/getAll").then(
        data=>{
            if (data.success) {
                const txtProveedor=document.querySelector("#id_proveedor");
                txtProveedor.innerHTML="";
                data.records.forEach(
                    (item,index)=>{
                        const{id_proveedor,proveedor}=item;
                        const optionProveedor=document.createElement("option");
                        optionProveedor.value=id_proveedor;
                        optionProveedor.textContent=proveedor;
                        txtProveedor.append(optionProveedor);
                    }
                );
                cargarProductos();
            }
        }
    ).catch(
        error=>{
            console.error("Error", error);
        }
    );
}

function cargarProductos() {
    API.get("productos/getAll").then(
        data=>{
            if (data.success) {
                const txtProducto=document.querySelector("#producto");
                txtProducto.innerHTML="";
                data.records.forEach(
                    (item,index)=>{
                        const{id_producto,descripcion}=item;
                        const optionProducto=document.createElement("option");
                        optionProducto.value=id_producto;
                        optionProducto.textContent=descripcion;
                        txtProducto.append(optionProducto);
                    }
                );
            }
        }
    ).catch(
        error=>{
            console.error("Error", error);
        }
    );
}

function agregarCompra() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(){
    formCompra.reset();
    formProducto.reset();
    document.querySelector("#id_fact").value="0";
    document.querySelector("#id_producto").value="0";
    divFoto.innerHTML="";
}

function cancelarCompra() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function crearTabla() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const{id_detalle, no_factura, precio, cantidad, descripcion, proveedor, fecha}=item;
            if (descripcion.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (precio.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (cantidad.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (no_factura.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (proveedor.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (fecha.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
        })
    }
    const recordIni=(objDatos.currentPage*objDatos.recordsShow)-objDatos.recordsShow;
    const recordFin=(recordIni+objDatos.recordsShow)-1;
    let html="";
    objDatos.recordsFilter.forEach(
        (item,index)=> {
            if ((index>= recordIni) && (index<=recordFin)) {
                html+=`
                    <tr>
                    <td>${index+1}</td>
                    <td>${item.no_factura}</td>               
                    <td>${item.descripcion}</td>    
                    <td>$ ${item.precio}</td>           
                    <td>${item.cantidad}</td>
                    <td>${item.fecha}</td>
                    <td>${item.proveedor}</td>
                    <td>
                        <button class="btn btn-outline-primary" onClick="editarCompra(${item.id_detalle})"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-outline-danger" onClick="eliminarCompra(${item.id_detalle})"><i class="bi bi-trash"></i></button>
                    </td>
                    </tr>
                `;
            }
        }
    );
    tableContent.innerHTML=html;
    crearPaginacion();

}

function crearPaginacion(){
    //borrar elementos
    pagination.innerHTML="";
    //boton anterior
    const elAnterior=document.createElement("li");
    elAnterior.classList.add("page-item");
    elAnterior.innerHTML=`<a class="page-link" href="#">Anterior</a>`;
    elAnterior.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==1 ? 1 : --objDatos.currentPage);
        crearTabla();
    };
    pagination.append(elAnterior);

    //numeros

    const totalPage=Math.ceil(objDatos.recordsFilter.length/objDatos.recordsShow);
    for (let i = 1; i <= totalPage; i++) {
        const el=document.createElement("li");
        el.classList.add("page-item");
        el.innerHTML=`<a class="page-link" href="#">${i}</a>`;
        el.onclick=()=>{
            objDatos.currentPage=i;
            crearTabla();
        };
        pagination.append(el);       
    }
    //boton siguiente
    const elSiguiente=document.createElement("li");
    elSiguiente.classList.add("page-item");
    elSiguiente.innerHTML=`<a class="page-link" href="#">Siguiente</a>`;
    elSiguiente.onclick=()=>{
        objDatos.currentPage=(objDatos.currentPage==totalPage ? totalPage : ++objDatos.currentPage);
        crearTabla();
    };
    pagination.append(elSiguiente);
}

function editarCompra(id){
    limpiarForm();
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("compras/getOneCompra?id="+id).then(
        data=>{
            if (data.success) {
                mostrarDatosForm(data.records[0]);
                
            }else{
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:data.msg
                });
            }
        }
    ).catch(
        error=>{
            console.log("Error", error);
        }
    );
}

function mostrarDatosForm(record){
    const {id_detalle, no_factura, precio, cantidad, descripcion, proveedor, total, fecha, foto}=record;
    document.querySelector("#id_fact").value=id_producto;
    document.querySelector("#no_fact").value=no_factura;
    document.querySelector("#precio").value=precio;
    document.querySelector("#total").value=total;
    document.querySelector("#cantidad").value=cantidad;
    document.querySelector("#id_producto").value=descripcion;
    document.querySelector("#id_proveedor").value=proveedor;
    document.querySelector("#fecha").value=fecha;
    divFotoP.innerHTML=`<img src="${foto}" class="h-100 w-100" style="object-fit:contain;">`;
    console.log(record);
}

function eliminarCompra(id){
    Swal.fire({
        title: "Esta seguro de eliminar la compra?",
        showDenyButton: true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        decision=>{
            if (decision.isConfirmed) {
                API.get("compras/deleteCompra?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarProducto();
                        }else{
                            Swal.fire({
                                icon:"error",
                                title:"Error",
                                Text:data.msg
                            });
                        }
                    }
                ).catch(
                    error=>{
                        console.err("Error", error);
                    }
                );
            }
        }
    );

}