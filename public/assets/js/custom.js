function togglePassword(id = 'password') {
    const input = document.getElementById(id);
    const icon = document.querySelector(`#${id} + .toggle-password`);
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.classList.toggle('fa-eye-slash');
}

function fillAmount(amount) {
    // Set the value of the input field
    $('#topupAmount').val(amount);

    // Enable the button and change its class to btn-danger
    $('#topupButton').prop('disabled', false);
    $('#topupButton').removeClass('btn-secondary').addClass('btn-danger');
}



    $(document).ready(function () {

        $('#hideSaldoBtn').click(function () {
            // Toggle between showing the actual balance and the masked version
            $('#balanceDisplay, #maskedBalanceDisplay').toggle();
            // Toggle between "Lihat Saldo" and "Hide Saldo"
            var buttonText = $('#toggleSaldoBtn h7').text();
            $('#toggleSaldoBtn h7').text(buttonText === 'Lihat Saldo' ? 'Hide Saldo' : 'Lihat Saldo');
        });

        // Attach an input event listener to the number input
        $('#topupAmount').on('input', function() {
            // Get the input value
            var inputVal = $(this).val();

            // Get the button element
            var topupButton = $('#topupButton');

            // Check if the input value is within the specified range
            if (inputVal >= 10000 && inputVal <= 1000000) {
                // Enable the button and change its class to btn-danger
                topupButton.prop('disabled', false);
                topupButton.removeClass('btn-secondary').addClass('btn-danger');
            } else {
                // Disable the button and change its class back to btn-secondary
                topupButton.prop('disabled', true);
                topupButton.removeClass('btn-danger').addClass('btn-secondary');
            }
        });

        // Menanggapi perubahan pada input file
        $('#file-input').change(function () {
            // Menampilkan nama file yang dipilih (opsional)
            var fileName = $(this).val().split('\\').pop();
            alert('Selected file: ' + fileName);
            console.log('cek');
            $('#upload-form').submit();
        });

        
    });

    document.getElementById('edit-btn').addEventListener('click', function () {
        // Menunjukkan tombol Simpan
        document.getElementById('save-btn').style.display = 'inline-block';
    
        // Mengaktifkan input
        document.getElementById('first_name').disabled = false;
        document.getElementById('last_name').disabled = false;
        // Menyembunyikan tombol Edit Profile dan Logout
        document.getElementById('edit-btn').style.display = 'none';
        document.getElementById('logout-btn').style.display = 'none';
    });