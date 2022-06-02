//Variables globales y selecctores
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const tableContent=document.querySelector("#contentTable table tbody");
const tableContentFact=document.querySelector("#contentTableFact table tbody");
const pagination=document.querySelector(".pagination");
const searchText=document.querySelector("#txtSearch");
const txtCantidad=document.querySelector("#cantidad");
var cant=0;
let total=0;
const API=new Api();
const factura=[];
const objDatos={
    records:[],
    recordsFilter:[],
    currentPage:1,
    recordsShow:5,
    filter:""
};
const objDatos2={
    records:[],
    recordsFilter:[],
    currentPage:1,
    recordsShow:20,
    filter:""
};

//Configuracion de eventos

eventListiners();

function eventListiners() {
    document.addEventListener("DOMContentLoaded",cargarDatos);
    searchText.addEventListener("input", aplicarFiltro);
    //btnAdd.addEventListener("click",agregarProducto);
    //btnCancelar.addEventListener("click",cancelarFactura);
    txtCantidad.addEventListener("input", setCantidad);
}

function setCantidad(element){
    element.preventDefault();
    cant=document.querySelector("#cantidad").value;
}

function cancelarFactura() {
    panelDatos.classList.remove("d-none");
    panelForm.classList.add("d-none");
    cargarDatos();
}

function cargarDatos() {
    API.get("facturas/getAll").then(
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


function crearTabla() {
    if (objDatos.filter==="") {
        objDatos.recordsFilter=objDatos.records.map(item=>item);
    } else {
        objDatos.recordsFilter=objDatos.records.filter(item=>{
            const{descripcion, precio}=item;
            if (descripcion.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (precio.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
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
                    <td><input type="number" class="form-control" id="cantidad" name="cantidad" required></td>
                    <td>
                    <button class="btn btn-outline-primary" onClick="agregarProducto(${item.id_producto, cant})"><i class="bi bi-file-plus"></i></button>
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

function aplicarFiltro(element){
    element.preventDefault();
    objDatos.filter=this.value;
    crearTabla();
}

function agregarProducto(id, cantidad){
    API.get("facturas/getOneProducto?id="+id).then(
        data=>{
            if (data.success) {
                objDatos2.records.push(data.records);
                objDatos2.currentPage=1;
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
    //objDatos2.records[objDatos2.records.length-1].push();
    //let subtotal=precio*cantidad;
    //total=total+subtotal;
    //objDatos2.records.push({Id: id_producto, Descripcion: descripcion, Precio: precio, Cantidad: cantidad, Subtotal: subtotal});
    objDatos2.currentPage=1;
    console.log(objDatos2.records);
    //mostrarFactura();
}

function mostrarFactura() {
    console.log(cantidad);
    if (objDatos2.filter==="") {
        objDatos2.recordsFilter=objDatos2.records.map(item=>item);
    } else {
        objDatos2.recordsFilter=objDatos2.records.filter(item=>{
            const{descripcion, precio}=item;
            if (descripcion.toUpperCase().search(objDatos2.filter.toUpperCase())!=-1) {
                return item;
            }
            if (precio.toUpperCase().search(objDatos2.filter.toUpperCase())!=-1) {
                return item;
            }
            /*if (Cantidad.toUpperCase().search(objDatos2.filter.toUpperCase())!=-1) {
                return item;
            }
            if (Subtotal.toUpperCase().search(objDatos2.filter.toUpperCase())!=-1) {
                return item;
            }*/
        })
    }
    const recordIni2=(objDatos2.currentPage*objDatos2.recordsShow)-objDatos2.recordsShow;
    const recordFin2=(recordIni2+objDatos2.recordsShow)-1;
    let html2="";
    objDatos2.recordsFilter.forEach(
        (item,index)=> {
            if ((index>= recordIni2) && (index<=recordFin2)) {
                html2+=`
                    <tr>
                    <td>${item.descripcion}</td>               
                    <td>$ ${item.precio}</td>             
                    <td>
                    <button class="btn btn-outline-danger" onClick="eliminarProducto(${item.id_producto})"><i class="bi bi-trash"></i></button>
                    </td>
                    </tr>
                `;
            }
        }
    );
    tableContentFact.innerHTML=html2;
    paginacion();

}

function paginacion(){
    //borrar elementos
    pagination.innerHTML="";
    //boton anterior
    const elAnterior=document.createElement("li");
    elAnterior.classList.add("page-item");
    elAnterior.innerHTML=`<a class="page-link" href="#">Anterior</a>`;
    elAnterior.onclick=()=>{
        objDatos2.currentPage=(objDatos2.currentPage==1 ? 1 : --objDatos2.currentPage);
        mostrarFactura();
    };
    pagination.append(elAnterior);

    //numeros

    const totalPage=Math.ceil(objDatos2.recordsFilter.length/objDatos2.recordsShow);
    for (let i = 1; i <= totalPage; i++) {
        const el=document.createElement("li");
        el.classList.add("page-item");
        el.innerHTML=`<a class="page-link" href="#">${i}</a>`;
        el.onclick=()=>{
            objDatos2.currentPage=i;
            mostrarFactura();
        };
        pagination.append(el);       
    }
    //boton siguiente
    const elSiguiente=document.createElement("li");
    elSiguiente.classList.add("page-item");
    elSiguiente.innerHTML=`<a class="page-link" href="#">Siguiente</a>`;
    elSiguiente.onclick=()=>{
        objDatos2.currentPage=(objDatos2.currentPage==totalPage ? totalPage : ++objDatos2.currentPage);
        mostrarFactura();
    };
    pagination.append(elSiguiente);
}