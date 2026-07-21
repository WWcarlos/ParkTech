Cypress.Commands.add('loginAdmin', () => {

    cy.visit('/login')

    cy.get('#email').type('admin@parking.com')

    cy.get('#password').type('12345678')

    cy.contains('Log in').click()

})