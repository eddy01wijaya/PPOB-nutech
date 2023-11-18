function registerUser() {
    const email = document.getElementById('email').value;
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    // Log all values
    console.log("Email:", email);
    console.log("First Name:", firstName.value);
    console.log("Last Name:", lastName.value);
    console.log("Password:", password.value);
    console.log("Confirm Password:", confirmPassword.value);


    // Check if any required field is empty
    if (isEmpty(email) || isEmpty(firstName) || isEmpty(lastName) || isEmpty(password) || isEmpty(confirmPassword)) {
        document.getElementById('responseMessage').innerText = "Semua field harus diisi";
        responseMessage.style.border = "1px solid red"; // Menambahkan border merah
        return;
    }

    // Perform client-side email format validation
    if (!isValidEmail(email)) {
        document.getElementById('responseMessage').innerText = "Email tidak valid";
        responseMessage.style.border = "1px solid red"; // Menambahkan border merah
        return;
    }

    // Perform client-side password confirmation check
    if (password.length < 8) {
        document.getElementById('responseMessage').innerText = "Password harus minimal 8 karakter";
        responseMessage.style.border = "1px solid red"; // Menambahkan border merah
        return;
    }

    // Perform client-side password confirmation check
    if (password !== confirmPassword) {
        document.getElementById('responseMessage').innerText = "Konfirmasi password tidak sesuai";
        responseMessage.style.border = "1px solid red"; // Menambahkan border merah
        return;
    }

    const userData = {
        email,
        first_name: firstName,
        last_name: lastName,
        password,
    };

     // Log the JSON data before sending the request
     console.log("JSON Data:", JSON.stringify(userData, null, 2));

    fetch('https://take-home-test-api.nutech-integrasi.app/registration', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(userData),
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('responseMessage').innerText = data.message;
        console.log(data.status);
        if (data.status === 0) {
            //document.getElementById('responseMessage').innerText = data.message;
            responseMessage.style.border = ""; // Menghapus border
            // Registration successful, show alert and redirect to login page
            alert("Registrasi berhasil! Silahkan login");
            // Assuming you have a login page, update the window.location accordingly
            window.location.href = '/login';
        } else {
            document.getElementById('responseMessage').innerText = "Gagal melakukan registrasi: " + data.message;
            responseMessage.innerText = "Login gagal: " + data.message;
            responseMessage.style.border = "1px solid red"; // Menambahkan border merah
        }
    })
    .catch(error => console.error('Error:', error));
    
}

function isEmpty(value) {
    if (value === undefined || value === null) {
        return true;
    }

    if (typeof value === 'string' && value.trim() === "") {
        return true;
    }

    return false;
}


function isValidEmail(email) {
    // Simple email format validation using a regular expression
    return /\S+@\S+\.\S+/.test(email);
}
