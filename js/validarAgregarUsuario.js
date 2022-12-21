const tipoUsuario = document.getElementById('tipoUsuario');
const form2 = document.getElementById('formulario');
const dni2 = document.getElementById('dni2');
const nombre2 = document.getElementById('nombre2');
const apellido2 = document.getElementById('apellido2');
const correo2 = document.getElementById('correo2');
const username2 = document.getElementById('username2');
const pass2 = document.getElementById('pass2');
const domicilio2 = document.getElementById('domicilio2');
const codPostal2 = document.getElementById('codPostal2');
const departamento2 = document.getElementById('departamento2');
const fechaNac2 = document.getElementById('fechaNac2');
const lugarNac2 = document.getElementById('lugarNac2');
const cel2 = document.getElementById('cel2');

const sedePreceptor2 = document.getElementById('sedePreceptor2');

const textEx2 = /^[a-zA-ZéúíóáñÑÉÚÍÓÁ' ]*$/;


const formElements2 = {
    dni: false,
    name: false, //Trae valor True o False
    apellido: false,
    correo: false,
    correoValid: false,
    username: false,
    usernameValid: false,
    pass: false,
    domicilio: true, //TRUE porque no son obligatorios
    codPostal: true,
    departamento: false,
    fechaNac: true,
    lugarNac: true,
    celular: false,
    sede: false,
}

tipoUsuario.addEventListener('change', (e) => {
    const tipoUsuario = e.target.value;

    if (tipoUsuario == 3) {
        formElements2.sede = true;
    } else {
        formElements2.sede = true;
    }
})

form2.addEventListener('submit', (e) => {
    e.preventDefault();

    const formValues = Object.values(formElements2);
    const valid = formValues.findIndex((value) => value == false);
    if (valid === -1) {
        form2.submit();
    } else {
        alert('Verificar los errores');
    }

})

dni2.addEventListener('input', (e) => {
    const numero = /^[0-9]+$/;
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const dni = e.target.value;

    if (dni.length < 7 || dni.length === '') {
        document.getElementById('dniError2').innerHTML = 'El DNI debe tener entre 7 u 8 dígitos númericos';
        $('#dniError2').css("color", "#F14B4B");
        formElements2.dni = false;
    }else if(!numero.test(dni)){
         document.getElementById('dniError2').innerHTML = 'Solo debe ingresar números';
        $('#dniError2').css("color", "#F14B4B");
        formElements2.dni = false;
    } else {
        document.getElementById('dniError2').innerHTML = '';
        formElements2.dni = true;
    }
    
    if(dni < 10000000 || dni > 47000000){
        document.getElementById('dniError2').innerHTML = 'El DNI debe ser entre los números 10.000.000 y 47.000.000';
        $('#dniError2').css("color", "#F14B4B");
        formElements2.dni = false;
    }else if(!numero.test(dni)){
         document.getElementById('dniError2').innerHTML = 'Solo debe ingresar números';
        $('#dniError2').css("color", "#F14B4B");
        formElements2.dni = false;
    }else{
        document.getElementById('dniError2').innerHTML = '';
        formElements2.dni = true;
    }

});

nombre2.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace('  ', ' ');
    e.target.value = e.target.value.replace('\'\'', '\'');

    const name = e.target.value;

    if (name.length < 3) {
        document.getElementById('nombreError2').innerHTML = 'El nombre debe tener al menos 3 caracteres';
        $('#nombreError2').css("color", "#F14B4B");
        formElements2.name = false;
    }else if(!textEx.test(name)){ 
        document.getElementById('nombreError2').innerHTML = 'Solo debe ingresar texto';
        $('#nombreError2').css("color", "#F14B4B");
        formElements2.name = false;
        
    }else {
        document.getElementById('nombreError2').innerHTML = '';
        formElements2.name = true;
    }

    if (!textEx2.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

});

apellido2.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace('  ', ' ');
    e.target.value = e.target.value.replace('\'\'', '\'');
    const apellido = e.target.value;

    if (apellido.length < 3) {
        document.getElementById('apellidoError2').innerHTML = 'El apellido debe tener al menos 3 caracteres';
        $('#apellidoError2').css("color", "#F14B4B");
        formElements2.apellido = false;
    }else if(!textEx.test(apellido)){ 
        document.getElementById('apellidoError2').innerHTML = 'Solo debe ingresar texto';
        $('#apellidoError2').css("color", "#F14B4B");
        formElements2.apellido = false;
    } else {
        document.getElementById('apellidoError2').innerHTML = '';
        formElements2.apellido = true;
    }
    if (!textEx2.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

});

correo2.addEventListener('input', (e) => {
   e.target.value = e.target.value.replace(' ', ''); 
});

correo2.addEventListener('change', (e) => {
    e.target.value = e.target.value.replace('\'', '"');
    const email = e.target;
    if (email.checkValidity()) {
        document.getElementById('correoError2').innerHTML = '';
        formElements2.correo = true;
    } else {
        document.getElementById('correoError2').innerHTML = 'Debe de tener un correo valido';
        $('#correoError2').css("color", "#F14B4B");
        formElements2.correo = false;
    }
});

function validarCorreoExistente(correo) {
    $.ajax({
        type: 'POST',
        url: '../vAdmin/pagesAjax/validarCorreoExistente.php',
        data: 'correo=' + correo.value,
        success: function (r) {
            if (!$.trim(r)) {
                $('#correoRepetido2').html(r);
                formElements2.correoValid = true;
            } else {
                $('#correoRepetido2').html(r);
                formElements2.correoValid = false;
            }
        }
    });
}


username2.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(' ', '');
    e.target.value = e.target.value.replace('\'', '"');
    
    if (!textEx2.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }
    
    const username = e.target.value;

    if (username.length < 6 || username.length === 0) {
        document.getElementById('userError2').innerHTML = 'El nombre de usuario debe tener al menos 6 caracteres no especiales y sin espacios';
        $('#userError2').css("color", "#F14B4B");
        formElements2.username = false;
    } else if(!textEx2.test(username)){ 
        document.getElementById('userError2').innerHTML = 'Solo debe ingresar texto';
        $('#userError2').css("color", "#F14B4B");
        formElements2.username = false;
    }
    else {
        document.getElementById('userError2').innerHTML = '';
        formElements2.username = true;
    }
});

function validarUsernameExistente(username) {
    $.ajax({
        type: 'POST',
        url: '../vAdmin/pagesAjax/validarUsernameExistente.php',
        data: 'username=' + username.value,
        success: function (r) {
            if (!$.trim(r)) {
                $('#userRepetido2').html(r);
                formElements2.usernameValid = true;
            } else {
                $('#userRepetido2').html(r);
                formElements2.usernameValid = false;
            }
        }
    })
}

pass2.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace('\'', '"');
    e.target.value = e.target.value.replace(' ', '');
    const password = e.target.value;

    if (password.length < 8 || password.length === 0) {
        document.getElementById('passError2').innerHTML = 'La contraseña debe tener como mínimo 8 caracteres sin espacios y sin comillas simples';
        $('#passError2').css("color", "#F14B4B");
        formElements2.pass = false;
    } else {
        document.getElementById('passError2').innerHTML = '';
        formElements2.pass = true;
    }
});

domicilio2.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace('  ', ' ');
    e.target.value = e.target.value.replace('\'', '"');
    const domicilio = e.target.value;

    if (domicilio.length === 0) {
        document.getElementById('domicilioError2').innerHTML = '';
        formElements2.domicilio = true;
    }
    else if (domicilio.length < 4) {
        document.getElementById('domicilioError2').innerHTML = 'El domicilio debe tener al menos 4 caracteres';
        $('#domicilioError2').css("color", "#F14B4B");
        formElements2.domicilio = false;
    } else {
        document.getElementById('domicilioError2').innerHTML = '';
        formElements2.domicilio = true;
    }
});

codPostal2.addEventListener('input', (e) => {
    const numero = /^[0-9]+$/;
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const codPostal = e.target.value;

    if (codPostal.length === 0) {
        document.getElementById('codPostalError2').innerHTML = '';
        formElements2.codPostal = true;
    }
    else if (codPostal.length < 4) {
        document.getElementById('codPostalError2').innerHTML = 'El código postal debe tener 4 dígitos númericos';
        $('#codPostalError2').css("color", "#F14B4B");
        formElements2.codPostal = false;
    }else if(!numero.test(codPostal)){
        document.getElementById('codPostalError2').innerHTML = 'Solo debe ingresar números';
        $('#codPostalError2').css("color", "#F14B4B");
        formElements2.codPostal = false;
    } else {
        document.getElementById('codPostalError2').innerHTML = '';
        formElements2.codPostal = true;
    }
});

departamento2.addEventListener('change', (e) => {
    const departamento = e.target.value;

    if (departamento === '') {
        document.getElementById('departamentoError2').innerHTML = 'Debe seleccionar una opción';
        $('#departamentoError2').css("color", "#F14B4B");
        formElements2.departamento = false;
    } else {
        document.getElementById('departamentoError2').innerHTML = '';
        formElements2.departamento = true;
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

    fechaNac2.min = '1955-01-01'
    fechaNac2.max = fecha;
})

fechaNac2.addEventListener('input', (e) => {
    const fechaNac = e.target.value;
    const fechaNacE = new Date(fechaNac);
    const year = fechaNacE.getFullYear();

    if (fechaNac > fecha) {
        document.getElementById('fechaNacError2').innerHTML = 'No debe ser mayor a la fecha ' + fecha;
        formElements2.fechaNac = false;
    } else if (year < 1950) {
        document.getElementById('fechaNacError2').innerHTML = 'No debe ser menor a la fecha 1950-01-01';
        formElements2.fechaNac = false;
    }else if (fechaNac < '1950-01-01') {
        document.getElementById('fechaNacError2').innerHTML = 'La fecha de nacimiento debe ser válida: El campo está incompleto o es una fecha inválida';
        formElements2.fechaNac = false;
    }else {
        document.getElementById('fechaNacError2').innerHTML = '';
        formElements2.fechaNac = true;
    }
    
    if (fechaNac.length === 0) {
        document.getElementById('fechaNacError2').innerHTML = '';
        formElements2.fechaNac = true;
    }
});

lugarNac2.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace('  ', ' ');
    e.target.value = e.target.value.replace('\'', '"');
    const lugarNac = e.target.value;

    if (lugarNac.length === 0) {
        document.getElementById('lugarNacError2').innerHTML = '';
        formElements2.lugarNac = true;
    }
    else if (lugarNac.length < 4) {
        document.getElementById('lugarNacError2').innerHTML = 'El lugar de nacimiento al menos 4 caracteres';
        $('#lugarNacError2').css("color", "#F14B4B");
        formElements2.lugarNac = false;
    } else {
        document.getElementById('lugarNacError2').innerHTML = '';
        formElements2.lugarNac = true;
    }
});

cel2.addEventListener('input', (e) => {
    const numero = /^[0-9]+$/;
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const cel = e.target.value;

    if (cel.length < 10) {
        document.getElementById('celError2').innerHTML = 'El número de celular debe tener 10 dígitos númericos';
        $('#celError2').css("color", "#F14B4B");
        formElements2.celular = false;
    }else if(!numero.test(cel)){
        document.getElementById('celError2').innerHTML = 'Solo debe ingresar numeros';
        $('#celError2').css("color", "#F14B4B");
        formElements2.celular = false;
    } else {
        document.getElementById('celError2').innerHTML = '';
        formElements2.celular = true;
    }

});

//PRECEPTOR

sedePreceptor2.addEventListener('change', (e) => {
    const sede = e.target.value;

    if (sede === '') {
        document.getElementById('sedePreceptorError2').innerHTML = 'Debe seleccionar una opción';
        $('#sedePreceptorError2').css("color", "#F14B4B");
        formElements2.sede = false;
    } else {
        document.getElementById('sedePreceptorError2').innerHTML = '';
        formElements2.sede = true;
    }
})


//Formulario invalido o vacio
//---------------------------

dni2.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('dniError2').innerHTML = 'Este campo es obligatorio';
        $('#dniError2').css("color", "#F14B4B");
        formElements2.dni = false;
    }

    formElements2.dni = false;

});


nombre2.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity("");

    if (e.target.value.length === 0) {
        document.getElementById('nombreError2').innerHTML = 'Este campo es obligatorio';
        $('#nombreError2').css("color", "#F14B4B");
    }

    formElements2.name = false;
});

apellido2.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity("");

    if (e.target.value.length === 0) {
        document.getElementById('apellidoError2').innerHTML = 'Este campo es obligatorio';
        $('#apellidoError2').css("color", "#F14B4B");
    }

    formElements2.apellido = false;

});

correo2.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity("");

    if (e.target.value.length === 0) {
        document.getElementById('correoError2').innerHTML = 'Este campo es obligatorio';
        $('#correoError2').css("color", "#F14B4B");
    }

    formElements2.correo = false;
});

username2.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('userError2').innerHTML = 'Este campo es obligatorio';
        $('#userError2').css("color", "#F14B4B");
    }

    formElements2.username = false;

});
pass2.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity("");

    if (e.target.value.length === 0) {
        document.getElementById('passError2').innerHTML = 'Este campo es obligatorio';
        $('#passError2').css("color", "#F14B4B");
    }

    formElements2.pass = false;
});

departamento2.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value === '') {
        document.getElementById('departamentoError2').innerHTML = 'Este campo es obligatorio';
        $('#departamentoError2').css("color", "#F14B4B");
        formElements2.departamento = false;
    }
    formElements2.departamento = false;
});

cel2.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value.length === 0) {
        document.getElementById('celError2').innerHTML = 'Este campo es obligatorio';
        $('#celError2').css("color", "#F14B4B");
    }
    formElements2.celular = false;

});


//PRECEPTOR
sedePreceptor2.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value === '') {
        document.getElementById('sedePreceptorError2').innerHTML = 'Debe seleccionar una opción';
        $('#sedePreceptorError2').css("color", "#F14B4B");
        formElements2.sede = false;
    } else {
        document.getElementById('sedePreceptorError2').innerHTML = '';
        formElements2.sede = true;
    }
})