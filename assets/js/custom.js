// Eye Show Password
{/* <i class="fas fa-eye-slash"></i> */}
const divPass = document.querySelectorAll('.password');

for (let i = 0; i < divPass.length; i++) {
    const divPassI = divPass[i];
    const inputEyePass = divPassI.querySelector('input[type="password"]');
    const eye = divPassI.querySelector('a.eye');
    const Ieye = eye.querySelector('i');

    if (eye) {
        eye.addEventListener('click' , function (e) { 
            e.preventDefault();
            e.stopPropagation();
            if (inputEyePass.value != "") {
                if (inputEyePass.type == 'password') {
                    inputEyePass.type = 'text';
                    Ieye.classList.replace('fa-eye','fa-eye-slash');
                } else {
                    inputEyePass.type = 'password';
                    Ieye.classList.replace('fa-eye-slash','fa-eye');
                }
            }
         })
    }
}