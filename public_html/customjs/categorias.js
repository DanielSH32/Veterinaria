//Variables globales y selecctores
const btnNew=document.querySelector("#btnAgregar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const btnCancelar=document.querySelector("#btnCancelar");
const tableContent=document.querySelector("#contentTable table tbody");
const searchText=document.querySelector("#txtSearch");
const pagination=document.querySelector(".pagination");
const formCategoria=document.querySelector("#formCategoria");
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
    btnNew.addEventListener("click",agregarCategoria);
    btnCancelar.addEventListener("click",cancelarCategoria);
    document.addEventListener("DOMContentLoaded",cargarDatos);
    searchText.addEventListener("input", aplicarFiltro);
    formCategoria.addEventListener("submit",guardarCategoria)
}

function guardarCategoria(event){
    event.preventDefault();
    const formData=new FormData(formCategoria);
    API.post(formData,"categorias/save").then(
        data=>{
            if (data.success) {
                cancelarCategoria();
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
    API.get("categorias/getAll").then(
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

function agregarCategoria() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(){
    formCategoria.reset();
    document.querySelector("#id_cate").value="0";
}

function cancelarCategoria() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function crearTabla() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const{id_cate, categoria}=item;
            if (categoria.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
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
                    <td>${item.categoria}</td>               
                    <td>
                        <button class="btn btn-outline-primary" onClick="editarCategoria(${item.id_cate})"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-outline-danger" onClick="eliminarCategoria(${item.id_cate})"><i class="bi bi-trash"></i></button>
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

function editarCategoria(id){
    limpiarForm();
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("categorias/getOneCategoria?id="+id).then(
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

function guardarCategoria(event){
    event.preventDefault();
    const formData=new FormData(formCategoria);
    API.post(formData,"categorias/save").then(
        data=>{
            if (data.success) {
                cancelarCategoria();
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
    const {id_cate, categoria}=record;
    document.querySelector("#id_cate").value=id_cate;
    document.querySelector("#categoria").value=categoria;
}

function eliminarCategoria(id){
    Swal.fire({
        title: "Esta seguro de eliminar el registro?",
        showDenyButton: true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        decision=>{
            if (decision.isConfirmed) {
                API.get("categorias/deleteCategoria?id="+id).then(
                    data=>{
                        if (data.success) {
                            cancelarCategoria();
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
                        console.log("Error", error);
                    }
                );
            }
        }
    );

}