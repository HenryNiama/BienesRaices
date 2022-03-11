/// <references types="cypress" />


describe('Carga la pagina Principal', () => {
    it('Prueba el Header de la pagina principal', () => {
        cy.visit('/');

        //Estoy seleccionando el h1, de mi layout en el heading.
       //Tuve q agregar un nuevo atributo a h1.
        cy.get('[data-cy="heading-sitio"]').should('exist');

        cy.get('[data-cy="heading-sitio"]').invoke('text').should('equal', 'Venta de casas y departamentos Exclusivos de Lujo');


    }); 
});