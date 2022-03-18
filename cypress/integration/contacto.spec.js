/// <reference types="cypress" />


describe('Prueba el Formulario de Contacto', ()=>{

    it('Prueba la pagina de contacto y el envio de emails', ()=>{
        cy.visit('/contacto');

        cy.get('[data-cy="heading-contacto"]').should('exist');
        cy.get('[data-cy="heading-contacto"]').invoke('text').should('equal', 'Contacto');

        cy.get('[data-cy="heading-formulario"]').should('exist');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el Formulario de Contacto');

    });


    it('Llena los campos del formulario', ()=>{
        cy.get('[data-cy="input-nombre"]').type('Juan');
        cy.get('[data-cy="input-mensaje"]').type('Deseo comprar una casa');
        cy.get('[data-cy="input-opciones"]').select('Compra');//O se puede tambien seleccionar "Vende"
        cy.get('[data-cy="input-precio"]').type('12000');
        cy.get('[data-cy="forma-contacto"]').eq(1).check();//Seleccionamos el primero con 0. Y seleccionamos el RadioButton con Check.

        cy.wait(3000);

        cy.get('[data-cy="forma-contacto"]').eq(0).check();

        cy.get('[data-cy="input-telefono"]').type('1231414141');

        cy.get('[data-cy="input-fecha"]').type('2022-03-30');

        cy.get('[data-cy="input-hora"]').type('12:30');

    });


});