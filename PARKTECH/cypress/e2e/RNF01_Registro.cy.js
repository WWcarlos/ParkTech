describe('RNF-01 Registro de entrada', () => {

    it('Debe registrar un vehículo correctamente', () => {

        cy.loginAdmin()

        cy.visit('/parking-records')

        cy.get('select[name="vehicle_id"] option')
            .first()
            .then(($option) => {
                cy.get('select[name="vehicle_id"]').select($option.val())
            })

        cy.get('select[name="user_id"] option')
            .first()
            .then(($option) => {
                cy.get('select[name="user_id"]').select($option.val())
            })

        cy.get('select[name="space_id"] option')
            .first()
            .then(($option) => {
                cy.get('select[name="space_id"]').select($option.val())
            })

        cy.get('input[name="entry_time"]').type('2026-07-20T10:00')
        cy.get('select[name="status"]').select('ACTIVE')

        cy.intercept('POST', '/parking-records').as('guardarRegistro')

        cy.contains('Guardar Registro').click()

        cy.wait('@guardarRegistro')
            .its('response.statusCode')
            .should('eq', 302)

        cy.contains('Registro creado correctamente.')

    })

})