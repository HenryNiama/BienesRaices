//Boton de hamburgueza:

document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));

}

function navegacionResponsive() {

    const navegacion = document.querySelector('.navegacion');

    // if (navegacion.classList.contains('mostrar')) {
    //     navegacion.classList.remove('mostrar');
    // }else{
    //     navegacion.classList.add('mostrar');
    // }

    navegacion.classList.toggle('mostrar');
}

//---------------------------------------------------------------

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    //console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        }
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

   if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
        <label for="telefono">Número de Teléfono: </label>
        <input data-cy="input-telefono" type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">
        
        <p>Si Elija la fecha y la hora para la llamada</p>

        <label for="fecha">Fecha</label>
        <input data-cy="input-fecha" type="date" value="fecha" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora</label>
        <input data-cy="input-hora" type="time"  id="hora" min="09:00" max="10:00" name="contacto[hora]">

        `;  
   }else{
    contactoDiv.innerHTML = `
    <label for="email">E-mail</label>
    <input data-cy="input-email" type="email" placeholder="Tu email" id="email" name="contacto[email]" required>

    `; 
   }
}