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

});