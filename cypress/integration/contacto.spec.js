/// <reference types="cypress" />



describe('Prueba el Formulario de Contacto', ()=>{

    it('Prueba la pagina de contacto y el envio de emails', ()=>{
        cy.visit('/contacto');

        cy.get('[data-cy="heading-contacto"]').should('exist');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('equal', 'Contacto');

        cy.get('[data-cy="heading-formulario"]').should('exist');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el Formulario de Contacto');

    });



});