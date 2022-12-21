const formNotas = document.getElementById('frmNotas');
const califParcial = document.getElementById('notaParcial');
const califRec = document.getElementById('notaRecup');
const califParcial2 = document.getElementById('notaParcial2');
const califRec2 = document.getElementById('notaRecup2');
const califGlobal = document.getElementById('notaGlobal');
const califFinal = document.getElementById('notaFinal');
const fechaFinal = document.getElementById('fechaFinal');
const califFinal2 = document.getElementById('notaFinal2');
const fechaFinal2 = document.getElementById('fechaFinal2');
const califFinal3 = document.getElementById('notaFinal3');
const fechaFinal3 = document.getElementById('fechaFinal3');
//const condicion = document.getElementById('condicion');

const numero = /^[0-9]+$/;

var btneditar = document.getElementById('btneditar');

const formElements2 = {
    califParcial: true,
    califRec: true,
    califParcial2: true,
    califRec2: true,
    califGlobal: true,
    califFinal: true,
    fechaFinal: true,
    califFinal2: true,
    fechaFinal2: true,
    califFinal3: true,
    fechaFinal3: true,
    condicion: true,
};

window.addEventListener("load", function (event) {

    if (califParcial.value >= 4) {
        califParcial.readOnly = true;
        califRec.readOnly = true;
    }

    if (califParcial2.value >= 4 || califParcial2.value != "") {
        califParcial2.readOnly = true;
        califRec2.readOnly = true;
    }

    if (califFinal.value != "") {
        califFinal.readOnly = true;
        fechaFinal.readOnly = true;

        if (califFinal.value >= 4) {
            califFinal2.value = null;
            fechaFinal2.value = null;
            califFinal3.value = null;
            fechaFinal3.value = null;

            califFinal2.readOnly = true;
            fechaFinal2.readOnly = true;

            califFinal3.readOnly = true;
            fechaFinal3.readOnly = true;

        } else {
            califFinal2.readOnly = false;
            fechaFinal2.readOnly = false;
        }
    }

    if (califFinal2.value != "") {

        califFinal2.readOnly = true;
        fechaFinal2.readOnly = true;

        if (califFinal2.value >= 4) {

            califFinal3.readOnly = true;
            fechaFinal3.readOnly = true;

            califFinal3.value = null;
            fechaFinal3.value = null;
        } else {
            califFinal3.readOnly = false;
            fechaFinal3.readOnly = false;
        }

    }

    if (califFinal3.value != "") {
        califFinal3.readOnly = true;
        fechaFinal3.readOnly = true;
    }

});

formNotas.addEventListener('submit', (e) => {
    e.preventDefault();

    const formValues = Object.values(formElements2);
    const valid = formValues.findIndex((value) => value === false);
    if (valid === -1) {
        formNotas.submit();
    } else {
        alert('Revisar los errores');
    }
});

btneditar.addEventListener('click', (e) => {
    califParcial.readOnly = false;
    califParcial2.readOnly = false;
    califFinal.readOnly = false;
    fechaFinal.readOnly = false;
    califFinal2.readOnly = false;
    fechaFinal2.readOnly = false;
    califFinal3.readOnly = false;
    fechaFinal3.readOnly = false;
});

califParcial.addEventListener('input', (e) => {
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const parcial = e.target.value;

    if (parcial > 10) {
        document.getElementById('parcialError').innerHTML = 'La nota no debe ser mayor a 10';
        $('#parcialError').css("color", "#F14B4B");
        formElements2.califParcial = false;
    } else {
        document.getElementById('parcialError').innerHTML = '';
        formElements2.califParcial = true;
    }
    if (califParcial.value >= 4 || califParcial.value == "") {
        califRec.readOnly = true;
    } else {
        califRec.readOnly = false;
    }


});

califRec.addEventListener('input', (e) => {
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const recup = e.target.value;
    if (recup > 10) {
        document.getElementById('recError').innerHTML = 'La nota no debe ser mayor a 10';
        $('#recError').css("color", "#F14B4B");
        formElements2.califRec = false;
    } else {
        document.getElementById('recError').innerHTML = '';
        formElements2.califRec = true;
    }

});

califParcial2.addEventListener('input', (e) => {
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const parcial2 = e.target.value;
    if (parcial2 > 10) {
        document.getElementById('parcial2Error').innerHTML = 'La nota no debe ser mayor a 10';
        $('#parcial2Error').css("color", "#F14B4B");
        formElements2.califParcial2 = false;
    } else {
        document.getElementById('parcial2Error').innerHTML = '';
        formElements2.califParcial2 = true;
    }
    if (califParcial2.value >= 4 || califParcial2.value == "") {
        califRec2.readOnly = true;
    } else {
        califRec2.readOnly = false;
    }
});

califRec2.addEventListener('input', (e) => {
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const recup2 = e.target.value;
    if (recup2 > 10) {
        document.getElementById('recup2Error').innerHTML = 'La nota no debe ser mayor a 10';
        $('#recup2Error').css("color", "#F14B4B");
        formElements2.califRec2 = false;
    } else {
        document.getElementById('recup2Error').innerHTML = '';
        formElements2.califRec2 = true;
    }
});

califGlobal.addEventListener('input', (e) => {
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const global = e.target.value;
    if (global > 10) {
        document.getElementById('globalError').innerHTML = 'La nota no debe ser mayor a 10';
        $('#globalError').css("color", "#F14B4B");
        formElements2.califGlobal = false;
    } else {
        document.getElementById('globalError').innerHTML = '';
        formElements2.califGlobal = true;
    }
});

califFinal.addEventListener('input', (e) => {
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const final = e.target.value;
    if (final > 10) {
        document.getElementById('finalError').innerHTML = 'La nota no debe ser mayor a 10';
        $('#finalError').css("color", "#F14B4B");
        formElements2.califFinal = false;
    } else {
        document.getElementById('finalError').innerHTML = '';
        formElements2.califFinal = true;
    }

    if (califFinal.value >= 4 || califFinal.value == "") {
        califFinal2.readOnly = true;
        fechaFinal2.readOnly = true;
        califFinal3.readOnly = true;
        fechaFinal3.readOnly = true;
    } else {
        califFinal2.readOnly = false;
        fechaFinal2.readOnly = false;
        califFinal3.readOnly = true;
        fechaFinal3.readOnly = true;
    }

    if (final !== '') {
        if (fechaFinal.value === '') {
            document.getElementById('fechaError').innerHTML = 'Debe especificar la fecha';
            $('#fechaError').css("color", "#F14B4B");
            formElements2.fechaFinal = false;
        }
    } else {
        document.getElementById('fechaError').innerHTML = '';
        $('#fechaError').css("color", "#F14B4B");
        formElements2.fechaFinal = true;
    }

});

califFinal2.addEventListener('input', (e) => {
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const final2 = e.target.value;
    if (final2 > 10) {
        document.getElementById('finalError2').innerHTML = 'La nota no debe ser mayor a 10';
        $('#finalError2').css("color", "#F14B4B");
        formElements2.califFinal2 = false;
    } else {
        document.getElementById('finalError2').innerHTML = '';
        formElements2.califFinal2 = true;
    }

    if (califFinal2.value >= 4) {
        califFinal.readOnly = true;
        fechaFinal.readOnly = true;
        califFinal3.readOnly = true;
        fechaFinal3.readOnly = true;

    } else {
        califFinal3.readOnly = false;
        fechaFinal3.readOnly = false;
    }

    if (califFinal.value >= 4) {
        $('#finalError2').css("color", "#F14B4B");
        document.getElementById('finalError2').innerHTML = 'El estudiante ya aprobo el primer final';
        formElements2.califFinal2 = false;
    }

    if (final2 !== '') {
        if (fechaFinal2.value === '') {
            document.getElementById('fechaError2').innerHTML = 'Debe especificar la fecha';
            $('#fechaError2').css("color", "#F14B4B");
            formElements2.fechaFinal2 = false;
        }
    } else {
        document.getElementById('fechaError2').innerHTML = '';
        $('#fechaError2').css("color", "#F14B4B");
        formElements2.fechaFinal2 = true;
    }

});

califFinal3.addEventListener('input', (e) => {
    if (!numero.test(e.target.value)) {
        e.target.value = e.target.value.substring(0, e.target.value.length - 1);
    }

    const final3 = e.target.value;
    if (final3 > 10) {
        document.getElementById('finalError3').innerHTML = 'La nota no debe ser mayor a 10';
        $('#finalError3').css("color", "#F14B4B");
        formElements2.califFinal3 = false;
    } else {
        document.getElementById('finalError3').innerHTML = '';
        formElements2.califFinal3 = true;
    }
    if (califFinal3.value >= 4) {
        califFinal.readOnly = true;
        fechaFinal.readOnly = true;
        califFinal2.readOnly = true;
        fechaFinal2.readOnly = true;
    }

    if (califFinal.value >= 4) {
        $('#finalError3').css("color", "#F14B4B");
        document.getElementById('finalError3').innerHTML = 'El estudiante ya aprobo el primer final';
        formElements2.califFinal2 = false;
    }
    else if (califFinal2.value >= 4) {
        $('#finalError3').css("color", "#F14B4B");
        document.getElementById('finalError3').innerHTML = 'El estudiante ya aprobo el segundo final';
        formElements2.califFinal2 = false;
    }

    if (final3 !== '') {
        if (fechaFinal3.value === '') {
            document.getElementById('fechaError3').innerHTML = 'Debe especificar la fecha';
            $('#fechaError3').css("color", "#F14B4B");
            formElements2.fechaFinal3 = false;
        }
    } else {
        document.getElementById('fechaError3').innerHTML = '';
        $('#fechaError3').css("color", "#F14B4B");
        formElements2.fechaFinal3 = true;
    }


});

//FECHAS FINALES-------

var fechaReversa = '';
window.addEventListener('load', (e) => {

    var dateReversa = new Date();
    dateReversa.setMonth(dateReversa.getMonth() - 12);
    var anioReversa = dateReversa.getFullYear();
    var mesReversa = String(dateReversa.getMonth() + 1).padStart(2, '0');
    var diaReversa = String(dateReversa.getDate()).padStart(2, '0');
    fechaReversa = anioReversa + '-' + mesReversa + '-' + diaReversa;

    var dateActual = new Date();
    dateActual.setHours(24);
    var anioActual = dateActual.getFullYear();
    var mesActual = String(dateActual.getMonth() + 1).padStart(2, '0');
    var diaActual = String(dateActual.getDate()).padStart(2, '0');
    fechaActual = anioActual + '-' + mesActual + '-' + diaActual;

    dateFechaFinal2 = new Date();
    dateFechaFinal2.setMonth(dateFechaFinal2.getMonth() + 3);
    var anioFecha2 = dateFechaFinal2.getFullYear();
    var mesFecha2 = String(dateFechaFinal2.getMonth() + 1).padStart(2, '0');
    var diaFecha2 = String(dateFechaFinal2.getDate()).padStart(2, '0');
    fechaMaxima2 = anioFecha2 + '-' + mesFecha2 + '-' + diaFecha2;

    dateFechaFinal3 = new Date();
    dateFechaFinal3.setMonth(dateFechaFinal3.getMonth() + 6);
    var anioFecha3 = dateFechaFinal3.getFullYear();
    var mesFecha3 = String(dateFechaFinal3.getMonth() + 1).padStart(2, '0');
    var diaFecha3 = String(dateFechaFinal3.getDate()).padStart(2, '0');
    fechaMaxima3 = anioFecha3 + '-' + mesFecha3 + '-' + diaFecha3;


    //Fecha FINAL 1
    fechaFinal.min = fechaReversa;
    fechaFinal.max = fechaActual;
    //FECHA FINAL 2
    fechaFinal2.max = fechaMaxima2;
    //FECHA FINAL 3
    fechaFinal3.max = fechaMaxima3;


});

fechaFinal.addEventListener('input', (e) => {
    const fechaFinal = e.target.value;

    document.getElementById('fechaError').innerHTML = '';
    formElements2.fechaFinal = true;
    fechaFinal2.value = '';
    fechaFinal3.value = '';
    fechaFinal2.min = fechaFinal;

    if (fechaFinal === '') {
        document.getElementById('fechaError').innerHTML = '';
        formElements2.fechaFinal = true;
        fechaFinal2.value = '';
        fechaFinal3.value = '';
    }

});

fechaFinal2.addEventListener('input', (e) => {
    const fechaFinal2 = e.target.value;

    if (fechaFinal2 <= fechaFinal.value) {
        document.getElementById('fechaError2').innerHTML = 'Debe ser mayor a la fecha del 1er Final';
        $('#fechaError2').css("color", "#F14B4B");
        formElements2.fechaFinal2 = false;
    } else {
        document.getElementById('fechaError2').innerHTML = '';
        formElements2.fechaFinal2 = true;
        fechaFinal3.value = '';
        fechaFinal3.min = fechaFinal2;
    }

    if (fechaFinal2 === '') {
        document.getElementById('fechaError2').innerHTML = '';
        formElements2.fechaFinal2 = true;
        fechaFinal3.value = '';
    }

})

fechaFinal3.addEventListener('input', (e) => {
    const fechaFinal3 = e.target.value;

    if (fechaFinal3 <= fechaFinal2.value || fechaFinal3 <= fechaFinal.value) {
        document.getElementById('fechaError3').innerHTML = 'Debe ser mayor a la fecha del 1er y 2do Final';
        $('#fechaError3').css("color", "#F14B4B");
        formElements2.fechaFinal3 = false;
    } else {
        document.getElementById('fechaError3').innerHTML = '';
        formElements2.fechaFinal3 = true;
    }

    if (fechaFinal3 === '') {
        document.getElementById('fechaError3').innerHTML = '';
        formElements2.fechaFinal3 = true;
    }

});



