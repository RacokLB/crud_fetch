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
                    const modalCortesia = new bootstrap.Modal(document.getElementById('exampleModal'));
                    modalCortesia.hide();
                    RegistrarCortesia();
                    
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
