//Elementos HTML
const mensaje=document.querySelector("#mensaje");
const form=document.querySelector("#formlogin");

//Configurar eventos

form.addEventListener("submit",login);

//Definicion de funciones

async function login(event) {
    event.preventDefault();
    const API=new Api();
    const formData= new FormData(form);
    API.post(formData,"login/validar").then(
        data=>{
            if (data.success) {
                window.location=data.url;
            } else {
                mensaje.classList.remove("d-none");
                mensaje.innerHTML=data.msg;
            }
        }
    ).catch(
        error=>{
            console.error("Error en la llamada:",error);
        }
    );
}