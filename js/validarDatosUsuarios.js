const form = document.getElementById('frmDatos');
const nombre = document.getElementById('nombre');/*Listo*/
const apellido = document.getElementById('apellido');
const domicilio = document.getElementById('domicilio');
const departamento = document.getElementById('codPostalDep');
const cPostal = document.getElementById('cPostal');
const lugarNac = document.getElementById('lugarNac');
const fechaNac = document.getElementById('fechaNac');
const cel = document.getElementById('cel');
const email = document.getElementById('correo');
const username = document.getElementById('username');
const passNueva = document.getElementById('passNueva');
const passRepetida = document.getElementById('passRepetida');
const btnSubmit = document.getElementById('btnSubmitDatos');


const textEx = /^[a-zA-ZéúíóáñÑÉÚÍÓÁ' ]*$/;

const formElements = {
    nombre: true,
    apellido: true,
    domicilio: true,
    departamento: true,
    email: true,
    cPostal: true,
    lugarNac: true,
    fechaNac: true,
    cel: true,
    username: true,
    passNueva: true,
    passRepetida: true,

}

window.addEventListener('load', (e) => {
    if (fechaNac.value === '') {
        formElements.fechaNac = false;
    }
})

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

    if (!textEx.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const nombre = e.target.value;
    if (nombre.length < 3) {
        document.getElementById('nombreError').innerHTML = 'El nombre debe tener al menos 3 caracteres';
        formElements.nombre = false;
    } else {
        document.getElementById('nombreError').innerHTML = '';
        formElements.nombre = true;
    }
});

apellido.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace('  ', ' ');

    if (!textEx.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const apellido = e.target.value;
    if (apellido.length < 4) {
        document.getElementById('apellidoError').innerHTML = 'El apellido debe tener al menos 4 caracteres';
        formElements.apellido = false;
    } else {
        document.getElementById('apellidoError').innerHTML = '';
        formElements.apellido = true;
    }
});

domicilio.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace('  ', ' ');
    e.target.value = e.target.value.replace('\'', '"');

    const domicilio = e.target.value;
    if (domicilio.length < 4) {
        document.getElementById('domicilioError').innerHTML = 'El domicilio debe tener al menos 4 caracteres';
        formElements.domicilio = false;
    } else {
        document.getElementById('domicilioError').innerHTML = '';
        formElements.domicilio = true;
    }
});

departamento.addEventListener('change', (e) => {
    const departamento = e.target.value;

    if (departamento === '') {
        document.getElementById('departamentoError').innerHTML = 'Debe seleccionar un campo';
        formElements.departamento = false;
    } else {
        document.getElementById('departamentoError').innerHTML = '';
        formElements.departamento = true;
    }
});

cPostal.addEventListener('input', (e) => {
    const numero = /^[0-9]+$/;
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const codigo = e.target.value;

    if (codigo.length < 4) {
        document.getElementById('cpostalError').innerHTML = 'El código postal debe tener 4 dígitos';
        formElements.cPostal = false;
    } else {
        document.getElementById('cpostalError').innerHTML = '';
        formElements.cPostal = true;
    }
});

lugarNac.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace('  ', ' ');
    e.target.value = e.target.value.replace('\'', '"');

    const lugar = e.target.value;

    if (lugar.length < 4) {
        document.getElementById('lugarNacError').innerHTML = 'El lugar debe tener al menos 4 caracteres';
        formElements.lugarNac = false;
    } else {
        document.getElementById('lugarNacError').innerHTML = '';
        formElements.lugarNac = true;

    }
});

var fecha = '';

window.addEventListener('load', (e) => {
    var date = new Date();
    date.setMonth(-204);
    var anio = date.getFullYear();
    var mes = String(date.getMonth() + 1).padStart(2, '0');
    var dia = String(date.getDate()).padStart(2, '0');

    fecha = anio + '-' + mes + '-' + dia;

    fechaNac.min = '1955-01-01'
    fechaNac.max = fecha;
})

fechaNac.addEventListener('input', (e) => {
    const fechaNac = e.target.value;

    if (fechaNac > fecha) {
        document.getElementById('fechaNacError').innerHTML = 'No debe ser mayor a la fecha ' + fecha;
        formElements.fechaNac = false;
    } else if (fechaNac < '1950-01-01') {
        document.getElementById('fechaNacError').innerHTML = 'No debe ser menor a la fecha 1950-01-01';
        formElements.fechaNac = false;
    } else {
        document.getElementById('fechaNacError').innerHTML = '';
        formElements.fechaNac = true;
    }

    if (fechaNac.length === 0) {
        document.getElementById('fechaNacError').innerHTML = 'Debe llenar la fecha de nacimiento';
        formElements.fechaNac = false;
    }else{
        document.getElementById('fechaNacError').innerHTML = '';
        formElements.fechaNac = true;
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
        formElements.cel = false;
    } else {
        document.getElementById('celError').innerHTML = '';
        formElements.cel = true;
    }
});

email.addEventListener('input', (e) => {
   e.target.value = e.target.value.replace(' ', ''); 
});

email.addEventListener('change', (e) => {
    e.target.value = e.target.value.replace('  ', ' ');
    e.target.value = e.target.value.replace('\'', '"');
    const email = e.target;
    if (email.checkValidity()) {
        document.getElementById('correoError').innerHTML = '';
        formElements.email = true;
    } else {
        document.getElementById('correoError').innerHTML = 'Debe colocar un correo válido';
        formElements.email = false;
    }
});

username.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(' ', '');
    e.target.value = e.target.value.replace('\'', '"');

    if (!textEx.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const username = e.target.value;

    if (username.length < 6) {
        document.getElementById('userError').innerHTML = 'El nombre de usuario debe tener al menos 6 caracteres';
        formElements.username = false;
    } else {
        document.getElementById('userError').innerHTML = '';
        formElements.username = true;
    }
});

passNueva.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(' ', '');
    e.target.value = e.target.value.replace('\'', '"');
    const pass = e.target.value;

    if (pass.length < 8) {
        document.getElementById('passNuevaError').innerHTML = 'La contraseña debe como mínimo 8 caracteres sin espacios y sin comillas simples';
        formElements.passNueva = false;
    } else {
        document.getElementById('passNuevaError').innerHTML = '';
        formElements.passNueva = true;
    }


    if(pass !== passRepetida.value){
        document.getElementById('passRepetidaError').innerHTML = 'Las contraseñas deben ser iguales';
        formElements.passRepetida = false;
    }else{
        document.getElementById('passRepetidaError').innerHTML = '';
        formElements.passRepetida = true;
    }


});


passRepetida.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(' ', '');
    e.target.value = e.target.value.replace('\'', '"');
    const passRepetida = e.target.value;

    if (passRepetida.length < 8) {
        document.getElementById('passRepetidaError').innerHTML = 'La contraseña debe como mínimo 8 caracteres sin espacios y sin comillas simples';
        formElements.passRepetida = false;
    }

    else if (passRepetida !== passNueva.value) {
        document.getElementById('passRepetidaError').innerHTML = 'Las contraseñas deben ser iguales';
        formElements.passRepetida = false;
    } else {
        document.getElementById('passRepetidaError').innerHTML = '';
        formElements.passRepetida = true;
    }
});




//FORMULARIO VACIO---

nombre.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('nombreError').innerHTML = 'Este campo es obligatorio';
        formElements.nombre = false;
    }

});

apellido.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('apellidoError').innerHTML = 'Este campo es obligatorio';
        formElements.apellido = false;
    }

});

domicilio.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('domicilioError').innerHTML = 'Este campo es obligatorio';
        formElements.domicilio = false;
    }

});

departamento.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('departamentoError').innerHTML = 'Este campo es obligatorio';
        formElements.departamento = false;
    }
});

cPostal.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('cpostalError').innerHTML = 'Este campo es obligatorio';
        formElements.cPostal = false;
    }

});

lugarNac.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('lugarNacError').innerHTML = 'Este campo es obligatorio';
        formElements.lugarNac = false;
    }

});

fechaNac.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('fechaNacError').innerHTML = 'Este campo es obligatorio';
        formElements.fechaNac = false;
    }

});

cel.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('celError').innerHTML = 'Este campo es obligatorio';
        formElements.cel = false;
    }

});

email.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('correoError').innerHTML = 'Este campo es obligatorio';
        formElements.email = false;
    }

});

username.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('userError').innerHTML = 'Este campo es obligatorio';
        formElements.username = false;
    }

});




