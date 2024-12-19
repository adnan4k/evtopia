<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Become A Seller - {{ config('app.name', 'ReadyEcommerce') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<style>
    body {
        background-color: #FFFFFF !important;
    }

    .wrapper {
        min-height: 100svh;
        display: flex;
    }

    .promotionSection {
        width: 35%;
        background-image: url("{{ asset('assets/images/shop-register.png') }}");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .registerFormSection {
        width: 65%;
        display: flex;
        flex-direction: column;
        row-gap: 24px;
    }

    @media (max-width: 767px) {
        .wrapper {
            flex-direction: column;
        }

        .promotionSection {
            display: none;
        }

        .registerFormSection {
            width: 100%;
        }
    }

    .step-indicators {
        display: flex;
        column-gap: 32px;
    }

    .indicator {
        width: 32px;
        height: 32px;
        padding: 4px;
        border-width: 1px;
        border-style: solid;
        border-color: var(--bs-border-color);
        border-radius: 50%;
    }

    .indicator.active {
        border-color: var(--theme-color);
    }

    .indicator-devider {
        width: 100%;
        top: 16px;
        left: 32px;
        border-bottom-width: 2px;
        border-bottom-style: dashed;
        border-color: var(--bs-border-color);
    }

    .step {
        display: flex;
        flex-direction: column;
        row-gap: 32px;
    }

    .information {
        position: relative;
        display: flex;
        flex-direction: column;
        padding: 32px 16px 16px;
        gap: 20px;
        isolation: isolate;
        border: 1px solid #D7DAE0;
        border-radius: 16px;
    }

    .title {
        font-weight: 500;
        font-size: 24px;
        line-height: 32px;
        padding: 0px 2px;
        position: absolute;
        left: 64px;
        top: -16px;
        background: #FFFFFF;
    }
</style>

<body>

    <div class="wrapper">
        <div class="promotionSection">
        </div>
      
        <div class="d-flex flex-column gap-4  justify-content-center align-items-center" style="width: 100%; height:100vh;">
            
            <div class="text-center">
                <h3 style="color:#228B22; font-weight: 600;">Evtopia</h2>    
                    <p>Register to become a seller</p>
                </div>    
            <div class="d-flex flex-column flex-md-row gap-4  justify-content-center align-items-center">
               <a href="/shop/individual"
               class="customButton2"
               >
                   Individual
               </a>
   
               <a  href="/shop/register" class="customButton2">
                   Shop Owner
               </a>

           </div>
           {{-- make it italic too --}}
           <a class="text-decoration-none" style="color:gray; font-weight: 600; font-size: 14px; font-style:italic;" href="/">
            <i class="fa-solid fa-arrow-left pe-2"></i> 
            Back To Home
            </a>
        </div>

       
    </div>

    <script src="{{ asset('assets/scripts/jquery-3.6.3.min.js') }}"></script>
    <script>
        $(function() {
            $('#nextBtn').on('click', function() {
                if (!validateStep()) {
                    return;
                }

                $('#step1').hide();
                $('#step2').show();
                $('#backBtn').removeClass('d-none');
                $('#indicator1').removeClass('active');
                $('#indicator2').addClass('active');
            });

            $('#backBtn').on('click', function() {
                $('#step2').hide();
                $(this).addClass('d-none');;
                $('#step1').show();
                $('#indicator2').removeClass('active');
                $('#indicator1').addClass('active');
            });

            $('#step1 input[required]').on('input', function() {
                $(this).removeClass('is-invalid');
                $('#' + $(this).attr('name') + '_error').text('')
            });
        });

        function validateStep() {
            let valid = true;

            const profilePhoto = $('input[name=profile_photo]');
            const firstName = $('input[name=first_name]');
            const phone = $('input[name=phone]');
            const email = $('input[name=email]');
            const password = $('input[name=password]');
            const passwordConfirmation = $('input[name=password_confirmation]');

            function setError(input, errorId, message) {
                $(errorId).text(message);
                input.addClass('is-invalid');
                valid = false;
            }

            function clearError(input, errorId) {
                $(errorId).text('');
                input.removeClass('is-invalid');
            }

            if (!profilePhoto.val()) {
                setError(profilePhoto, '#profile_photo_error', 'Profile photo is required.');
            } else {
                clearError(profilePhoto, '#profile_photo_error');
            }

            if (!firstName.val()) {
                setError(firstName, '#first_name_error', 'First name is required.');
            } else {
                clearError(firstName, '#first_name_error');
            }

            if (!phone.val()) {
                setError(phone, '#phone_error', 'Phone number is required.');
            } else {
                clearError(phone, '#phone_error');
            }

            if (!email.val()) {
                setError(email, '#email_error', 'Email is required.');
            } else {
                clearError(email, '#email_error');
            }

            if (!password.val()) {
                setError(password, '#password_error', 'Password is required.');
            } else if (password.val().length < 6) {
                setError(password, '#password_error', 'Password must be at least 6 characters long.');
            } else {
                clearError(password, '#password_error');
            }

            if (!passwordConfirmation.val()) {
                setError(passwordConfirmation, '#password_confirmation_error', 'Password confirmation is required.');
            } else if (password.val() !== passwordConfirmation.val()) {
                setError(passwordConfirmation, '#password_confirmation_error', 'Passwords do not match.');
            } else {
                clearError(passwordConfirmation, '#password_confirmation_error');
            }

            return valid;
        }

        var previewFile = (event, previewID) => {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(previewID);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };

        function checkDescription() {
            if (document.getElementById('description').value.length > 200) {
                document.getElementById('descriptionError').innerHTML =
                    'Description must be less than or equal to 220 characters';
            } else {
                document.getElementById('descriptionError').innerHTML = '';
            }
        }
    </script>
</body>

</html>
