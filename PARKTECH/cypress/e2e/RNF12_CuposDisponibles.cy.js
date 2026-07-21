describe('RNF-12 Mostrar cupos', () => {

    it('Visualizar tarjetas de cupos', () => {

        cy.loginAdmin()

        cy.visit('/parking-records')

        cy.contains('Cupos Disponibles')
        cy.contains('Cupos Ocupados')
        cy.contains('Capacidad Total')

    })

})