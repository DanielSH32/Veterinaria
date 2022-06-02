//Variables globales y selecctores
const btnNew=document.querySelector("#btnAgregar");
const btnCancelar=document.querySelector("#btnCancelar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const formCliente=document.querySelector("#formCliente");
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
    btnNew.addEventListener("click",agregarCliente);
    btnCancelar.addEventListener("click",cancelarCliente);
    document.addEventListener("DOMContentLoaded",cargarDatos);
    searchText.addEventListener("input", aplicarFiltro);
    formCliente.addEventListener("submit",guardarCliente)
}

//Funciones

function guardarCliente(event){
    event.preventDefault();
    const formData=new FormData(formCliente);
    API.post(formData,"clientes/save").then(
        data=>{
            if (data.success) {
                cancelarCliente();
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

function cargarDatos() {
    API.get("clientes/getAll").then(
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

function aplicarFiltro(element){
    element.preventDefault();
    objDatos.filter=this.value;
    crearTabla();
}

function agregarCliente() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(){
    formCliente.reset();
    document.querySelector("#id_cliente").value="0";
}

function cancelarCliente() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function crearTabla() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const{nombre, apellido, DUI, direccion, email, telefono}=item;
            if (nombre.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (apellido.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (DUI.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (direccion.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (email.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
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
                    <td>${item.nombre}</td>               
                    <td>${item.apellido}</td>               
                    <td>${item.DUI}</td>
                    <td>${item.direccion}</td>
                    <td>${item.email}</td>
                    <td>${item.telefono}</td>
                    <td>
                        <button class="btn btn-outline-primary" onClick="editarCliente(${item.id_cliente})"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-outline-danger" onClick="eliminarCliente(${item.id_cliente})"><i class="bi bi-trash"></i></button>
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

function editarCliente(id){
    limpiarForm();
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("clientes/getOneCliente?id="+id).then(
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
    const {id_cliente, nombre, apellido, DUI, direccion, email, telefono}=record;
    document.querySelector("#id_cliente").value=id_cliente;
    document.querySelector("#nombre").value=nombre;
    document.querySelector("#apellido").value=apellido;
    document.querySelector("#dui").value=DUI;
    document.querySelector("#direccion").value=direccion;
    document.querySelector("#email").value=email;
    document.querySelector("#telefono").value=telefono;
    console.log(record);
}

function eliminarCliente(id){
    Swal.fire({
        title: "Esta seguro de eliminar el cliente?",
        showDenyButton: true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        decision=>{
            if (decision.isConfirmed) {
                API.get("clientes/deleteCliente?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarCliente();
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