const form = document.getElementById('frmRegistro');
const nombre = document.getElementById('nombre');
const apellido = document.getElementById('apellido');
const departamento = document.getElementById('departamento');
const email = document.getElementById('email');
const dni = document.getElementById('dni');
const cel = document.getElementById('cel');
const username = document.getElementById('username');
const password = document.getElementById('password');

const textEx = /^[a-zA-ZéúíóáñÑÉÚÍÓÁ ]*$/;

const formElements = {
    nombre: false,
    apellido: false,
    departamento: false,
    email: false,
    dni: false,
    cel: false,
    username: false,
    password: false
}

form.addEventListener('submit', (e) => {
    e.preventDefault();

    const formValues = Object.values(formElements);
    const valid = formValues.findIndex(value => value === false);

    if (valid === -1) {
        form.submit();
    } else {
        alert('Verifica los errores');
    }
});

nombre.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace('  ', ' ');
    const textExNom = /^[a-zA-ZéúíóáñÑÉÚÍÓÁ' ]*$/;

    if (!textExNom.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const nombre = e.target.value;

    if (nombre.length < 3) {
        document.getElementById('nombreError').innerHTML = 'El nombre debe tener al menos 3 caracteres';
        $('#nombreError').css("color", "#F14B4B");
        formElements.nombre = false;
    }
    else {
        document.getElementById('nombreError').innerHTML = '';
        formElements.nombre = true;
    }
});

apellido.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace('  ', ' ');
    const textExAp = /^[a-zA-ZéúíóáñÑÉÚÍÓÁ' ]*$/;

    if (!textExAp.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const apellido = e.target.value;

    if (apellido.length < 3) {
        document.getElementById('apellidoError').innerHTML = 'El apellido debe tener al menos 3 caracteres';
        $('#apellidoError').css("color", "#F14B4B");
        formElements.apellido = false;
    } else {
        document.getElementById('apellidoError').innerHTML = '';
        formElements.apellido = true;
    }
});

function validarDepartamentos(valor) {
    const departamento = valor.value;

    if (departamento === '') {
        document.getElementById('departamentoError').innerHTML = 'Debe seleccionar un campo';
        $('#departamentoError').css("color", "#F14B4B");
        formElements.departamento = false;
    } else {
        document.getElementById('departamentoError').innerHTML = '';
        formElements.departamento = true;
    }
}

email.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(' ', '');
});

email.addEventListener('input', (e) => {
   e.target.value = e.target.value.replace(' ', ''); 
});

email.addEventListener('change', (e) => {
    const email = e.target;
    if (email.checkValidity()) {
        document.getElementById('correoError').innerHTML = '';
        formElements.email = true;
    } else {
        document.getElementById('correoError').innerHTML = 'Debe colocar un correo válido';
        $('#correoError').css("color", "#F14B4B");
        formElements.email = false;
    }
});

dni.addEventListener('input', (e) => {
    const numero = /^[0-9]+$/;
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const dni = e.target.value;

    if (dni.length < 7) {
        document.getElementById('dniError').innerHTML = 'El DNI debe tener 7 o 8 dígitos';
        $('#dniError').css("color", "#F14B4B");
        formElements.dni = false;
    } else {
        document.getElementById('dniError').innerHTML = '';
        formElements.dni = true;
    }
    
    if(dni < 10000000 || dni > 47000000){
        document.getElementById('dniError').innerHTML = 'El DNI debe tener entre 10000000 y 47000000';
        $('#dniError').css("color", "#F14B4B");
        formElements.dni = false;
    }else{
        document.getElementById('dniError').innerHTML = '';
        formElements.dni = true;
    }
});

cel.addEventListener('input', (e) => {
    const numero = /^[0-9]+$/;
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const cel = e.target.value;

    if (cel.length < 10) {
        document.getElementById('celError').innerHTML = 'El número de celular debe tener 10 dígitos';
        $('#celError').css("color", "#F14B4B");
        formElements.cel = false;
    } else {
        document.getElementById('celError').innerHTML = '';
        formElements.cel = true;
    }

});

username.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(' ', '');
    e.target.value = e.target.value.replace('\'', '"');
    const username = e.target.value;

    if (!textEx.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    if (username.length < 6) {
        document.getElementById('userError').innerHTML = 'El nombre de usuario debe tener al menos 6 caracteres sin espacios y sin comillas simples';
        $('#userError').css("color", "#F14B4B");
        formElements.username = false;
    } else {
        document.getElementById('userError').innerHTML = '';
        formElements.username = true;
    }
});

password.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(' ', '');
    e.target.value = e.target.value.replace('\'', '"');
    const pass = e.target.value;

    if (pass.length < 8) {
        document.getElementById('passError').innerHTML = 'La contraseña debe como minimo 8 caracteres sin espacios y sin comillas simples';
        $('#passError').css("color", "#F14B4B");
        formElements.password = false;
    } else {
        document.getElementById('passError').innerHTML = '';
        formElements.password = true;
    }
})

//FORMULARIO VACIO---

nombre.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('nombreError').innerHTML = 'Este campo es obligatorio';
        $('#nombreError').css("color", "#F14B4B");
        formElements.nombre = false;
    }

});

apellido.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('apellidoError').innerHTML = 'Este campo es obligatorio';
        $('#apellidoError').css("color", "#F14B4B");
        formElements.apellido = false;
    }

});

function departamentoInvalido(valor) {
    event.preventDefault();
    valor.setCustomValidity('');

    if (valor.value.length === 0) {
        document.getElementById('departamentoError').innerHTML = 'Este campo es obligatorio';
        $('#departamentoError').css("color", "#F14B4B");
        formElements.departamento = false;
    }
}

email.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('correoError').innerHTML = 'Este campo es obligatorio';
        $('#correoError').css("color", "#F14B4B");
        formElements.email = false;
    }

});

dni.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('dniError').innerHTML = 'Este campo es obligatorio';
        $('#dniError').css("color", "#F14B4B");
        formElements.dni = false;
    }

});

cel.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('celError').innerHTML = 'Este campo es obligatorio';
        $('#celError').css("color", "#F14B4B");
        formElements.cel = false;
    }

});

username.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('userError').innerHTML = 'Este campo es obligatorio';
        $('#userError').css("color", "#F14B4B");
        formElements.username = false;
    }

});

password.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('passError').innerHTML = 'Este campo es obligatorio';
        $('#passError').css("color", "#F14B4B");
        formElements.password = false;
    }

});



