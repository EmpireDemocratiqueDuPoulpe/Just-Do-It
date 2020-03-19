function checkForm(form) {

    const formElements = form.elements;
    const usernameInput = formElements.username;
    const emailInput = formElements.email;
    const passwordInput = formElements.password;
    const password1Input = formElements.password1;
    const password2Input = formElements.password2;

    // Check username
    if (usernameInput) {

        // Check length
        if (usernameInput.value.length < usernameInput.minLength || usernameInput.value.length > usernameInput.maxLength) {
            usernameInput.setCustomValidity("Nom d'utilisateur trop court/long");
            return false;
        }
    }

    // Check email
    if (emailInput) {

        // Check length
        if (emailInput.value.length < emailInput.minLength || emailInput.value.length > emailInput.maxLength) {
            emailInput.setCustomValidity("Email trop court/long");
            return false;
        }

        // Check validity
        const emailRegex = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

        if (!emailRegex.test(emailInput.value)) {
            emailInput.setCustomValidity("E-mail non conforme");
            return false;
        }
    }

    // Check password
    const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,255}$/;

    if (passwordInput) {

        // Check length
        if (passwordInput.value.length < passwordInput.minLength || passwordInput.value.length > passwordInput.maxLength) {
            passwordInput.setCustomValidity("Mot de passe trop court/long");
            return false;
        }

        // Check validity
        if (!passwordRegex.test(passwordInput.value)) {
            passwordInput.setCustomValidity("Mot de passe invalide");
            return false;
        }
    }

    // Check password1
    if (password1Input) {

        // Check length
        if (password1Input.value.length < password1Input.minLength || password1Input.value.length > password1Input.maxLength) {
            password1Input.setCustomValidity("Mot de passe trop court/long");
            password2Input.setCustomValidity("Mot de passe trop court/long");
            return false;
        }

        // Check validity
        if (!passwordRegex.test(password1Input.value)) {
            password1Input.setCustomValidity("Mot de passe invalide");
            password2Input.setCustomValidity("Mot de passe invalide");
            return false;
        }
    }

    // Check password2
    if (password2Input) {

        // Check length
        if (password2Input.value.length < password2Input.minLength || password2Input.value.length > password2Input.maxLength) {
            password1Input.setCustomValidity("Mot de passe trop court/long");
            password2Input.setCustomValidity("Mot de passe trop court/long");
            return false;
        }

        // Check validity
        if (!passwordRegex.test(password2Input.value)) {
            password1Input.setCustomValidity("Mot de passe invalide");
            password2Input.setCustomValidity("Mot de passe invalide");
            return false;
        }
    }

    // Check password1 and password2
    if (password1Input && password2Input) {

        if (password1Input.value !== password2Input.value) {
            password1Input.setCustomValidity("Les mots de passe ne correspondent pas");
            password2Input.setCustomValidity("Les mots de passe ne correspondent pas");
            return false;
        }
    }

    return true;
}