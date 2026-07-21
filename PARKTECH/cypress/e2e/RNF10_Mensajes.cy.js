describe('RNF-10 Mensajes', () => {

    it('Debe mostrar mensaje al registrar correctamente', () => {

        cy.loginAdmin()

        cy.visit('/parking-records')

        // Seleccionar la primera opción disponible
        cy.get('select[name="vehicle_id"] option')
            .eq(0)
            .then(option => {
                cy.get('select[name="vehicle_id"]').select(option.val())
            })

        cy.get('select[name="user_id"] option')
            .eq(0)
            .then(option => {
                cy.get('select[name="user_id"]').select(option.val())
            })

        cy.get('select[name="space_id"] option')
            .eq(0)
            .then(option => {
                cy.get('select[name="space_id"]').select(option.val())
            })

        cy.get('input[name="entry_time"]').type('2026-07-20T10:00')

        cy.get('select[name="status"]').select('ACTIVE')

        cy.contains('Guardar Registro').click()

        cy.contains('Registro creado correctamente.')

    })

})