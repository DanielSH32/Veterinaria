//variables y selectores
const btnViewReport=document.querySelector("#btnViewReport");
const fecha=document.querySelector("#fecha");
const fecha2=document.querySelector("#fecha2");
const frameReporte=document.querySelector("#framereporte");
const API = new Api();

//Eventos
eventListener();

function eventListener(){
    //document.addEventListener("DOMContentLoaded",cargarDatos);
    btnViewReport.addEventListener("click",verReporte)
}

//funciones

function cargarDatos(){
    API.get("proveedores/getAll").then(
        data=>{
            if (data.success) {
                idProveedor.innerHTML="";
                const optionProveedor=document.createElement("option");
                optionProveedor.value="0";
                optionProveedor.textContent="todos";
                idProveedor.append(optionProveedor);
                data.records.forEach(
                    (item,index)=>{
                        const{id_proveedor,proveedor}=item;
                        const optionProveedor=document.createElement("option");
                        optionProveedor.value=id_proveedor;
                        optionProveedor.textContent=proveedor;
                        idProveedor.append(optionProveedor);
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
                idCate.innerHTML="";
                const optionCategoria=document.createElement("option");
                optionCategoria.value="0";
                optionCategoria.textContent="todos";
                idCate.append(optionCategoria);
                data.records.forEach(
                    (item,index)=>{
                        const{id_cate,categoria}=item;
                        const optionCategoria=document.createElement("option");
                        optionCategoria.value=id_cate;
                        optionCategoria.textContent=categoria;
                        idCate.append(optionCategoria);
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

function verReporte(){
    frameReporte.src=`${BASE_API}reporteventas/getReporte?fecha=${fecha.value}&fecha2=${fecha2.value}`;
}