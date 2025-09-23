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

RegistrarParientes();
function RegistrarParientes(busqueda){
    fetch("../Models/parientsView_controller.php", {
        method:"POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        //en el codigo de abajo mostramos los datos que se buscaron en el archivo listarcitas.php usando el # resultado que se encuentra en el tbody
        resultado.innerHTML = response;
    })
}


// SCRIPT DEL MODULO PARIENTES
function Seleccionar(id){
    fetch('../Models/parentsSelects_controller.php',{
        method:"POST",
        body:id
    }).then(response => response.json()).then(response => {
        Swal.fire({
            title: "Usted eligio a esta persona?",
            icon: "warning",
            background:"#090a09",
            backdrop: `
            rgba(0,0,123,0.4)
            `,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡CONFIRMO!"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Seleccionado",
                icon: "success",
                background:"#090a09",
                backdrop: `
                rgba(195, 220, 83, 0.3)
                `,
                timer: 1000,
                showConfirmButton: false
              });
                document.getElementById('idpersonas').value = response.id;
                document.getElementById('cedulaTitular').value = response.trabajador_id;
                document.getElementById('edades').value = response.edad;
                document.getElementById('nexo').value = response.parentesco;
                document.getElementById('coordinacionPariente').value = response.coordinacionPariente;
                const modalPariente = new bootstrap.Modal(document.getElementById('formularioParienteModal'));
                modalPariente.show();
                RegistrarParientes();
                }
            
          });
//de esta manera capturamos los ID de los campos que tenemos en nuestro archivo index.php serian ID.value y con response.ID, por ejemplo response.nombre etc.. llenamos los inputs con los datos que tenemos en la tabla
        
    })
}
registrar_modal.addEventListener("click", () =>{
    fetch("../Models/insertParents_controller.php",{
        method:"POST",
        body: new FormData(formularioPariente)
    }).then(response => response.text()).then(response => {
        console.log(response);
        if(response == "Right"){
            Swal.fire({
                title: "Registrado",
                icon: "success",
                showConfirmButton: "true",
                confirmButtonText: "Confirmar",
                confirmButtonColor: "#63DD33",
                cancelButtonColor: "#d33",
                timer:2000,
                background:"#090a09",
                backdrop: `
                rgba(195, 220, 83, 0.3)
                `
              }).then((result) => {
                if(result.isConfirmed){
                    
                    const modalInstance = bootstrap.Modal.getInstance(document.getElementById('formularioParienteModal'));
                    modalInstance.hide();
                    RegistrarParientes();
                    formulario.reset();
                    location.reload();
                    }
                })
        }else{
            Swal.fire({
                title: "ERROR",
                text: "Verifique los campos",
                icon: "warning",
                showConfirmButton: true,
                timer: 2000,
                background:"#090a09",
                backdrop: `
                rgba(0,0,123,0.4)
                `
              })
        }
    })
})

        
buscarPariente.addEventListener("keyup", () =>{
    const valor = buscarPariente.value;
    if(valor == ""){
        RegistrarParientes();
    }else{
        RegistrarParientes(valor);
    }
})