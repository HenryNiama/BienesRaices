/// <reference types="cypress" />


describe('probar la Autenticacion', () =>{

    it('Prueba la Autenticacion en /login', () =>{
        cy.visit('/login');

        cy.get('[data-cy="heading-login"]').should('exist');
        cy.get('[data-cy="heading-login"]').should('have.text', 'Iniciar Sesión');

        cy.get('[data-cy="formulario-login"]').should('exist');

        //Ambos campos son obligatorios
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta-login"]').should('exist');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.class', 'error');//Esta es la primera alerta
        // cy.get('[data-cy="alerta-login"]').first().should('have.text', 'Aqui escribo lo que deberia ir, ojo con espacios');

        cy.get('[data-cy="alerta-login"]').eq(1).should('have.class', 'error');//Esta es la segunda alerta


        //El usuario exista


        //Verificar el password

    });
});