// Define an object called 'user' with empty strings for the 'username', 'email', and 'password' fields.
var user = {
    username: '',
    email: '',
    password: ''
};

// Create a user object from the form input values
function createUserFromForm() {
    var form = document.getElementById('signup-form');
    var username = form.elements['username'].value;
    var email = form.elements['email'].value;
    var password = form.elements['password'].value;

    var user = {
        username: username,
        email: email,
        password: password
    };

    return user;
}

// Function to validate the username.
function validateUsername() {
    var username = document.getElementById('username').value;
    if (username.length < 3) {
        alert('Username must be at least 3 characters long.');
        return false;
    } else {
        user.username = username;
        return true;
    }
}

// Function to validate the email.
function validateEmail() {
    var email = document.getElementById('email').value;
    var re = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    if (!re.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    } else {
        user.email = email;
        return true;
    }
}

// Function to validate the password.
function validatePassword() {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm-password').value;

    if (password.length < 8) {
        alert('Password must be at least 8 characters long.');
        return false;
    } else if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
    } else {
        user.password = password;
        return true;
    }
}

// Function to handle the form submission.
window.onload = function() {
    document.getElementById('submit-button').addEventListener('click', function(event) {
        event.preventDefault();

        if (validateUsername() && validateEmail() && validatePassword()) {
            var user = createUserFromForm();

            // Send an AJAX request to 'submit_signup.php' with the form data.
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'submit_signup.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Display the result of the operation.
                    alert(xhr.responseText);
                }
            };
            xhr.send('username=' + encodeURIComponent(user.username) + '&email=' + encodeURIComponent(user.email) + '&password=' + encodeURIComponent(user.password));
        }
    });
};