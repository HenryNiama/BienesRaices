/// <reference types="cypress" />


describe('Carga la pagina Principal', () => {

    it('Prueba el Header de la pagina principal', () => {
        cy.visit('/');

        //Estoy seleccionando el h1, de mi layout en el heading.
       //Tuve q agregar un nuevo atributo a h1.
        cy.get('[data-cy="heading-sitio"]').should('exist');

        cy.get('[data-cy="heading-sitio"]').invoke('text').should('equal', 'Venta de casas y departamentos Exclusivos de Lujo');
    }); 


    it('Prueba el Bloque de los Iconos Principales', ()=>{
        cy.get('[data-cy="heading-nosotros"]').should('exist');
        //Verificamos si tienes las etiquetas HTML adecuadas:
        cy.get('[data-cy="heading-nosotros"]').should('have.prop', 'tagName').should('equal', 'H2');
    

        //Selecciona los iconos:
        cy.get('[data-cy="iconos-nosotros"]').should('exist');

        //Comprobando que sea tres iconos:
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('have.length', 3);
        //tambien se la puede negar
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('not.have.length', 4);
    });


    it('Prueba la seccion de Propiedades', ()=>{

        //Debe haber 3 propiedades
        cy.get('[data-cy="anuncio"]').should('have.length', 3);
        cy.get('[data-cy="anuncio"]').should('not.have.length', 5);

        //Probar el enlace de las propiedades
        cy.get('[data-cy="enlace-propiedad"]').should('have.class', 'boton-amarillo-block');
        cy.get('[data-cy="enlace-propiedad"]').should('not.have.class', 'boton-verde');
        // cy.get('[data-cy="enlace-propiedad"]').first().invoke('text').should('equal', 'Ver Propiedad');


        //Probar el enlace a una propiedad
        cy.get('[data-cy="enlace-propiedad"]').first().click();
        cy.get('[data-cy="titulo-propiedad"]').should('exist');
        cy.wait(1000);//En milisegundos
        cy.go('back');
    });


    it('Probando el Routing hacia todas las Propiedades', ()=>{
        cy.get('[data-cy="todas-propiedades"]').should('exist');
        cy.get('[data-cy="todas-propiedades"]').should('have.class', 'boton-verde');
        cy.get('[data-cy="todas-propiedades"]').invoke('attr', 'href').should('equal', '/public/propiedades');
        cy.get('[data-cy="todas-propiedades"]').click();
        cy.get('[data-cy="heading-propiedades"]').invoke('text').should('equal', 'Casas y Depas en Venta');

        cy.wait(1000);//En milisegundos
        cy.go('back');
    });

    //Probando el bloque de contacto:
    it('Prueba el Bloque de Contacto', ()=>{
        cy.get('[data-cy="imagen-contacto"]').should('exist');
        cy.get('[data-cy="imagen-contacto"]').find('h2').invoke('text').should('equal', 'Encuentra la casa de tus sue??os');
        //La siguiente sirve para verificar que las URLs esten funcionando y me refirijan a esa pagina
        cy.get('[data-cy="imagen-contacto"]').find('a').invoke('attr', 'href')
        .then( href => {
            cy.visit(href)
        })

        cy.get('[data-cy="heading-contacto"]').should('exist');
        cy.wait(2500);
        cy.visit('/');//Aqui va visit, y no go, por que arriba usamos el .then que es para visitar. 
    });

    it('Probando Blog y los Testimoniales', ()=>{
        cy.get('[data-cy="blog"]').should('exist');
        cy.get('[data-cy="blog"]').find('h3').invoke('text').should('equal', 'Nuestro Blog');
        cy.get('[data-cy="blog"]').find('img').should('have.length', 2);
        

        cy.get('[data-cy="testimoniales"]').should('exist');
        cy.get('[data-cy="testimoniales"]').find('h3').invoke('text').should('equal', 'Testimoniales');


    });

});