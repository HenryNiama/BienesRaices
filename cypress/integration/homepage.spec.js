/// <references types="cypress" />


describe('Carga la pagina Principal', () => {
    it('Prueba el Header de la pagina principal', () => {
        cy.visit('/');

        //Estoy seleccionando el h1, de mi layout en el heading.
        cy.get('[data-cy="heading-sitio"]');//Tuve q agregar un nuevo atributo a h1.


    }); 
});