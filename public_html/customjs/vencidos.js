//Variables globales y selecctores
const btnNew=document.querySelector("#btnPDF");
const tableContent=document.querySelector("#contentTable table tbody");
const panelDatos=document.querySelector("#contentList");
const panelForm=document.querySelector("#contentForm");
const frameReporte=document.querySelector("#framereporte");
const pagination=document.querySelector(".pagination");
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
    btnNew.addEventListener("click",generarPDF);
    document.addEventListener("DOMContentLoaded",cargarDatos);
}

//Funciones

function generarPDF(){
    panelDatos.classList.add("d-none");
    panelForm.classList.remove("d-none");
    verReporte();
}

function verReporte(){
    frameReporte.src=`${BASE_API}vencidos/getReporte?cantidad=0`;
}

function cargarDatos() {
    API.get("vencidos/getVencidos").then(
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
            const{descripcion, precio, cantidad, vencimiento, proveedor}=item;
            if (descripcion.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (precio.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (cantidad.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
                return item;
            }
            if (vencimiento.toUpperCase().search(objDatos.filter.toUpperCase())!=-1) {
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
                    <td>${item.vencimiento}</td>
                    <td>${item.proveedor}</td>
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