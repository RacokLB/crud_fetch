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

//SCRIPT FOR MODAL CORTESIA 
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
                timer: 500      
              }).then((result) => {
                if (result.isConfirmed){
                    formCortesia.reset();
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

//SCRIPT FOR MODULO TRABAJADORES
RegistrarPersonas();
function RegistrarPersonas(busqueda){
    fetch("../Models/workerView_controller.php", {
        method:"POST",
        body: busqueda
    }).then(response => response.text()).then(response => {
        //en el codigo de abajo mostramos los datos que se buscaron en el archivo listarcitas.php usando el # resultado que se encuentra en el tbody
        resultado.innerHTML = response;
    })
}



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
                    formulario.reset();
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

function Seleccionar(id){
    fetch("../Models/workerSelect_controller.php",{
        method: "POST",
        body: id
    }).then(response => response.json()).then(response => {
        Swal.fire({
            title: "Usted eligio a esta persona?",
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
              Swal.fire({
                title: "Seleccionado",
                icon: "success",
                background:"#090a09",
                backdrop: `
                rgba(195, 220, 83, 0.3)
                `
              });
                idpersonas.value = id;
                paciente.value = response.cedula;
                edades.value = response.edad;
                coordinaciones.value = response.coordinacion;
            }
            
          });
//de esta manera capturamos los ID de los campos que tenemos en nuestro archivo index.php serian ID.value y con response.ID, por ejemplo response.nombre etc.. llenamos los inputs con los datos que tenemos en la tabla
        
    })
}

buscar.addEventListener("keyup", () =>{
    const valor = buscar.value;
    if(valor == ""){
        RegistrarPersonas();
    }else{
        RegistrarPersonas(valor);
    }
})
//other function 


//)
