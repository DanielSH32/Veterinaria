//variables y selectores
const btnViewReport=document.querySelector("#btnViewReport");
const fecha=document.querySelector("#fecha");
const fecha2=document.querySelector("#fecha2");
const idProveedor=document.querySelector("#id_proveedor");
const frameReporte=document.querySelector("#framereporte");
const API = new Api();

//Eventos
eventListener();

function eventListener(){
    document.addEventListener("DOMContentLoaded",cargarDatos);
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
            }
        }
    ).catch(
        error=>{
            console.error("Error", error);
        }
    );
}

function verReporte(){
    frameReporte.src=`${BASE_API}reportecompras/getReporte?fecha=${fecha.value}&fecha2=${fecha2.value}&id_proveedor=${idProveedor.value}`;
}