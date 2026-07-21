describe('RNF-03 Cupos', () => {

    it('Debe mostrar los cupos disponibles', () => {

        cy.loginAdmin()

        cy.visit('/parking-records')

        cy.contains('Cupos Disponibles')
        cy.contains('Cupos Ocupados')
        cy.contains('Capacidad Total')

    })

})