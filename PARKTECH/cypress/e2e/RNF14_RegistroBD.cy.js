describe('RNF-14 Registro', () => {

    it('Registrar parqueo', () => {

        cy.loginAdmin()

        cy.visit('/parking-records')

        // Seleccionar el primer vehículo disponible
        cy.get('select[name="vehicle_id"] option')
            .first()
            .then(($option) => {
                cy.get('select[name="vehicle_id"]').select($option.val())
            })

        // Seleccionar el primer usuario disponible
        cy.get('select[name="user_id"] option')
            .first()
            .then(($option) => {
                cy.get('select[name="user_id"]').select($option.val())
            })

        // Seleccionar el primer espacio disponible
        cy.get('select[name="space_id"] option')
            .first()
            .then(($option) => {
                cy.get('select[name="space_id"]').select($option.val())
            })

        cy.get('input[name="entry_time"]').type('2026-07-20T11:00')

        cy.get('select[name="status"]').select('ACTIVE')

        cy.contains('Guardar Registro').click()

        cy.contains('Registro creado correctamente.')

    })

})