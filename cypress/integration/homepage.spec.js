/// <references types="cypress" />


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

});