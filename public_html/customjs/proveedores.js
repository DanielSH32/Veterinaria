//Variables globales y selecctores
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const pagination=document.querySelector(".pagination");
const formProveedor=document.querySelector("#formProveedor");
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
    btnNew.addEventListener("click",agregarProveedor);
    btnCancelar.addEventListener("click",cancelarProveedor);
    document.addEventListener("DOMContentLoaded",cargarDatos);
    searchText.addEventListener("input", aplicarFiltro);
    formProveedor.addEventListener("submit",guardarProveedor)
}

function guardarProveedor(event){
    event.preventDefault();
    const formData=new FormData(formProveedor);
    API.post(formData,"proveedores/save").then(
        data=>{
            if (data.success) {
                cancelarProveedor();
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
            console.log("Error", error);
        }
    );
}

function aplicarFiltro(element){
    element.preventDefault();
    objDatos.filter=this.value;
    crearTabla();
}

function cargarDatos() {
    API.get("proveedores/getAll").then(
        data=>{
            if (data.success) {
                objDatos.records=data.records;
                objDatos.currentPage=1;
                crearTabla();
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

function agregarProveedor() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(){
    formProveedor.reset();
    document.querySelector("#id_proveedor").value="0";
}

function cancelarProveedor() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function crearTabla() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const{id_proveedor,proveedor,contacto,telefono}=item;
            if (proveedor.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (contacto.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (telefono.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
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
                    <td>${item.proveedor}</td>
                    <td>${item.contacto}</td>
                    <td>${item.telefono}</td>               
                    <td>
                        <button class="btn btn-outline-primary" onClick="editarProveedor(${item.id_proveedor})"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-outline-danger" onClick="eliminarProveedor(${item.id_proveedor})"><i class="bi bi-trash"></i></button>
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

function editarProveedor(id){
    limpiarForm();
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("proveedores/getOneProveedor?id="+id).then(
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

function guardarProveedor(event){
    event.preventDefault();
    const formData=new FormData(formProveedor);
    API.post(formData,"proveedores/save").then(
        data=>{
            if (data.success) {
                cancelarProveedor();
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
            console.log("Error", error);
        }
    );
}

function mostrarDatosForm(record){
    const {id_proveedor, proveedor, contacto, telefono}=record;
    document.querySelector("#id_proveedor").value=id_proveedor;
    document.querySelector("#proveedor").value=proveedor;
    document.querySelector("#contacto").value=contacto;
    document.querySelector("#telefono").value=telefono;
}

function eliminarProveedor(id){
    Swal.fire({
        title: "Esta seguro de eliminar el proveedor?",
        showDenyButton: true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        decision=>{
            if (decision.isConfirmed) {
                API.get("proveedores/deleteProveedor?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarProveedor();
                            Swal.fire({
                                icon:"info",
                                Text:data.msg
                            });
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

