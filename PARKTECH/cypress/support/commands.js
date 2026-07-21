Cypress.Commands.add('loginAdmin', () => {

    cy.visit('/login')

    cy.get('#email').type('admin@parking.com')

    cy.get('#password').type('admin123')

    cy.contains('Log in').click()

})