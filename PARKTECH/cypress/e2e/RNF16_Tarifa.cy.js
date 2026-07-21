describe('RNF-16 Tarifa', () => {

    it('Registrar salida', () => {

        cy.loginAdmin()

        cy.visit('/parking-records')

        cy.contains('Dar Salida').first().click()

        cy.contains('Salida registrada correctamente')

    })

})