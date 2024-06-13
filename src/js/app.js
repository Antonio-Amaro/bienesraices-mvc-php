document.addEventListener('DOMContentLoaded', function(){
    
    eventListeners();

    //darkMode();
});

//function darkMode(){

    // const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);

    // if(prefiereDarkMode.matches) {
    //     document.body.classList.add('dark-mode');
    // } else {
    //     document.body.classList.remove('dark-mode');
    // }

    // prefiereDarkMode.addEventListener('change', function() {
    //     if(prefiereDarkMode.matches) {
    //         document.body.classList.add('dark-mode');
    //     } else {
    //         document.body.classList.remove('dark-mode');
    //     }
    // });

    // const botonDarkMode = document.querySelector('.dark-mode-boton');
    // botonDarkMode.addEventListener('click', function() {
    //     document.body.classList.toggle('dark-mode');
    // });
//}

function eventListeners(){

    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]')
    metodoContacto.forEach( input => input.addEventListener('click', mostrarMetodosContacto));
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');

    // Funcion para agregar y quitar clase
    navegacion.classList.toggle('mostrar');
}

function mostrarMetodosContacto(e) {
    
    const contactoDiv = document.querySelector('#contacto');
    
    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" placeholder="Ingrese su teléfono" name="contacto[telefono]" required>

            <p>Elija la fecha y la hora de la llamada</p>

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora</label>
            <input type="time" id="hora" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" id="email" placeholder="Correo electrónico" name="contacto[email]" required>
        `;
    }

}