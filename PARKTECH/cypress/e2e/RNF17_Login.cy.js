describe('RNF-17 Login', () => {

    it('No ingresar sin autenticarse', () => {

        cy.visit('/dashboard')

        cy.url().should('include','login')

    })

})