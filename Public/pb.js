const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

document.querySelector(".theme-toggle").addEventListener("click",() => {
    toggleLocalStorage();
    toggleRootClass();
});

function toggleRootClass(){
    const current = document.documentElement.getAttribute('data-bs-theme');
    const inverted = current == 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-bs-theme',inverted);
}

function toggleLocalStorage(){
    if(isLight()){
        localStorage.removeItem("light");
    }else{
        localStorage.setItem("light","set");
    }
}

function isLight(){
    return localStorage.getItem("light");
}

if(isLight()){
    toggleRootClass();
}




// SCRIPT FOR MODULO TRABAJADORES
RegistrarPersonas();
function RegistrarPersonas(busqueda){
    fetch("../Models/workerViewPb_controller.php", {
        method:"POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        resultado.innerHTML = response;
    })
}

// NOTE: This part is for the old form on the main page.
// The new functionality moves this to the modal.
// I've kept the original for reference, but we won't use it directly now.
/*
registrar.addEventListener("click",()=>{
    fetch("../Models/insertWorkers_controller.php",{
        method: "POST",
        body: new FormData(formulario)
    }).then(response => response.text()).then(response =>{
        console.log(response)
        if(response == "Right"){
            Swal.fire({
                title: "EXITO",
                text:"Persona Registrada",
                icon: "success",
                showConfirmButton: true,
                confirmButtonText: "Confirmar",
                confirmButtonColor: "#63DD33",
                cancelButtonColor: "#d33",
                background:"#090a09",
                backdrop: `
                rgba(195, 220, 83, 0.3)
                `,
                timer: 2000
            }).then((result) => {
                if (result.isConfirmed){
                    RegistrarPersonas();
                    location.reload();
                }
            });
        }else{
            Swal.fire({
                title: "ERROR",
                text: "Verifique los campos",
                icon: "warning",
                showConfirmButton: true,
                timer: 2000
            });
        }
    })
})
*/

function Eliminar(id){
    Swal.fire({
        title: "¿Usted esta seguro?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Rechazar"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("../Models/eliminar.php",{
                method:"POST",
                body: id
            }).then(response => response.text()).then(response =>{
                if(response =="Right"){
                    RegistrarPersonas();
                    Swal.fire({
                        icon: "success",
                        title: "Eliminado",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    });
}

// NEW FUNCTIONALITY TO HANDLE MODAL
function Seleccionar(id){
    fetch("../Models/workerSelect_controller.php",{
        method: "POST",
        body: id
    }).then(response => response.json()).then(response => {
        // Here we show the confirmation modal first, as in your original code
        Swal.fire({
            title: "Usted eligió a esta persona?",
            icon: "warning",
            background:"#090a09",
            backdrop: `
            rgba(0,0,123,0.4)
            `,
            showCancelButton: true,
            confirmButtonColor: "#63DD33",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡CONFIRMO!"
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, show the success message and then open the new form modal
                Swal.fire({
                    title: "Seleccionado",
                    icon: "success",
                    background:"#090a09",
                    backdrop: `
                    rgba(195, 220, 83, 0.3)
                    `,
                    timer: 1000,
                    showConfirmButton: false
                }).then(() => {
                    // Populate and open the new modal for the medical consultation
                    document.getElementById('idpersonas').value = response.id;
                    document.getElementById('paciente').value = response.cedula;
                    document.getElementById('edades').value = response.edad;
                    document.getElementById('coordinaciones').value = response.coordinacion;

                    const consultaModal = new bootstrap.Modal(document.getElementById('consultaModalPb'));
                    consultaModal.show();
                    RegistrarPersonas();
                    
                    
                    
                });
            }
        });
    });
}

// SCRIPT TO HANDLE FORM SUBMISSION FROM MODAL
const registrarModalBtn = document.getElementById("registrar_modal");
registrarModalBtn.addEventListener("click", () => {
    const formulario = document.getElementById("formulario_consulta_pb");
    fetch("../Models/insertWorkers_controller.php", {
        method: "POST",
        body: new FormData(formulario)
    }).then(response => response.text()).then(response => {
        console.log(response);
        if (response == "Right") {
            Swal.fire({
                title: "EXITO",
                text: "Consulta registrada correctamente",
                icon: "success",
                showConfirmButton: true,
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#63DD33",
                background: "#090a09",
                backdrop: `
                rgba(195, 220, 83, 0.3)
                `
            }).then(() => {
                const modalInstance = bootstrap.Modal.getInstance(document.getElementById('consultaModalPb'));
                modalInstance.hide();
                RegistrarPersonas();
                formulario.reset();
                location.reload(true);
            });
        } else {
            Swal.fire({
                title: "ERROR",
                text: "Hubo un problema al registrar la consulta",
                icon: "warning",
                showConfirmButton: true,
                timer: 2000
            });
        }
    });
});

buscar.addEventListener("keyup", () =>{
    const valor = buscar.value;
    if(valor == ""){
        RegistrarPersonas();
    }else{
        RegistrarPersonas(valor);
    }
})

// SCRIPT FOR MODAL CORTESIA
registrarCortesia.addEventListener("click",()=>{
    fetch("../Models/insertCortesia_controller.php",{
        method: "POST",
        body: new FormData(formCortesia)
    }).then(response => response.text()).then(response =>{
        console.log(response)
        if(response == "Right"){
            Swal.fire({
                title: "EXITO",
                text:"Persona Registrada",
                icon: "success",
                showConfirmButton: true,
                confirmButtonText: "Confirmar",
                confirmButtonColor: "#63DD33",
                cancelButtonColor: "#d33",
                background:"#090a09",
                backdrop: `
                rgba(195, 220, 83, 0.3)
                `,
                timer: 5000
            }).then((result) => {
                if (result.isConfirmed){
                    formCortesia.reset();
                    const modalCortesia = new bootstrap.Modal(document.getElementById('fttcModal'));
                    modalCortesia.hide();
                    location.reload();
                    
                }
            });
        }else{
            Swal.fire({
                title: "ERROR",
                text: "Verifique los campos",
                icon: "warning",
                showConfirmButton: true,
                timer: 500
            });
        }
    })
})