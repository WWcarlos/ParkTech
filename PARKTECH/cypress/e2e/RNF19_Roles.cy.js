describe('RNF-19 Roles', () => {

    it('Administrador puede ingresar a usuarios', () => {

        cy.loginAdmin()

        cy.visit('/users')

        cy.contains('Gestión de Usuarios')

    })

})