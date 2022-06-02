//Variables globales y selecctores
const btnNew=document.querySelector("#btnAgregar");
const btnCancelar=document.querySelector("#btnCancelar");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const formProducto=document.querySelector("#formProducto");
const divFotoP=document.querySelector("#divFotoP");
const inputFotoP=document.querySelector("#fotop");
const divFotoM=document.querySelector("#divFotoM");
const inputFotoM=document.querySelector("#fotom");
const divFotoG=document.querySelector("#divFotoG");
const tableContent=document.querySelector("#contentTable table tbody");
const pagination=document.querySelector(".pagination");
const searchText=document.querySelector("#txtSearch");
const inputFotoG=document.querySelector("#fotog");
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
    btnNew.addEventListener("click",agregarProducto);
    btnCancelar.addEventListener("click",cancelarProducto);
    document.addEventListener("DOMContentLoaded",cargarDatos);
    searchText.addEventListener("input", aplicarFiltro);
    divFotoP.addEventListener("click", agregarFotoP);
    inputFotoP.addEventListener("change", actualizarFotoP);
    divFotoM.addEventListener("click", agregarFotoM);
    inputFotoM.addEventListener("change", actualizarFotoM);
    divFotoG.addEventListener("click", agregarFotoG);
    inputFotoG.addEventListener("change", actualizarFotoG);
    formProducto.addEventListener("submit",guardarProducto)
}

//Funciones

function guardarProducto(event){
    event.preventDefault();
    const formData=new FormData(formProducto);
    API.post(formData,"productos/save").then(
        data=>{
            if (data.success) {
                cancelarProducto();
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

function agregarFotoP(){
    inputFotoP.click();
}

function actualizarFotoP(el){
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            console.log(e.target.result);
            divFotoP.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}

function agregarFotoM(){
    inputFotoM.click();
}

function actualizarFotoM(el){
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            console.log(e.target.result);
            divFotoM.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}

function agregarFotoG(){
    inputFotoG.click();
}

function actualizarFotoG(el){
    if (el.target.files && el.target.files[0]) {
        const reader=new FileReader();
        reader.onload=e=>{
            console.log(e.target.result);
            divFotoG.innerHTML=`<img src="${e.target.result}" class="h-100 w-100" style="object-fit:contain;">`;
        }
        reader.readAsDataURL(el.target.files[0]);
    }
}

function cargarDatos() {
    API.get("productos/getAll").then(
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
                cargarCategorias();
            }
        }
    ).catch(
        error=>{
            console.error("Error", error);
        }
    );
}

function cargarCategorias() {
    API.get("categorias/getAll").then(
        data=>{
            if (data.success) {
                const txtCategoria=document.querySelector("#id_cate");
                txtCategoria.innerHTML="";
                data.records.forEach(
                    (item,index)=>{
                        const{id_cate,categoria}=item;
                        const optionCategoria=document.createElement("option");
                        optionCategoria.value=id_cate;
                        optionCategoria.textContent=categoria;
                        txtCategoria.append(optionCategoria);
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


function agregarProducto() {
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    limpiarForm();
}

function limpiarForm(){
    formProducto.reset();
    document.querySelector("#id_producto").value="0";
    divFotoP.innerHTML="";
    divFotoM.innerHTML="";
    divFotoG.innerHTML="";
}

function cancelarProducto() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function crearTabla() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const{descripcion, precio, cantidad, categoria, proveedor}=item;
            if (descripcion.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (precio.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (cantidad.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (categoria.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (proveedor.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
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
                    <td>${item.descripcion}</td>               
                    <td>$ ${item.precio}</td>               
                    <td>${item.cantidad}</td>
                    <td>${item.categoria}</td>
                    <td>${item.proveedor}</td>
                    <td>
                        <button class="btn btn-outline-primary" onClick="editarProducto(${item.id_producto})"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-outline-danger" onClick="eliminarProducto(${item.id_producto})"><i class="bi bi-trash"></i></button>
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

function editarProducto(id){
    limpiarForm();
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    API.get("productos/getOneProducto?id="+id).then(
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
    const {id_producto, descripcion, precio, cantidad, categoria, proveedor, fotop, fotom, fotog}=record;
    document.querySelector("#id_producto").value=id_producto;
    document.querySelector("#descripcion").value=descripcion;
    document.querySelector("#precio").value=precio;
    document.querySelector("#cantidad").value=cantidad;
    document.querySelector("#id_cate").value=categoria;
    document.querySelector("#id_proveedor").value=proveedor;
    divFotoP.innerHTML=`<img src="${fotop}" class="h-100 w-100" style="object-fit:contain;">`;
    divFotoM.innerHTML=`<img src="${fotom}" class="h-100 w-100" style="object-fit:contain;">`;
    divFotoG.innerHTML=`<img src="${fotog}" class="h-100 w-100" style="object-fit:contain;">`;
    console.log(record);
}

function eliminarProducto(id){
    Swal.fire({
        title: "Esta seguro de eliminar el producto?",
        showDenyButton: true,
        confirmButtonText:"Si",
        denyButtonText:"No"
    }).then(
        decision=>{
            if (decision.isConfirmed) {
                API.get("productos/deleteProducto?id="+id).then(
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