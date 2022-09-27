const frmInscribir = document.getElementById('frmInscribir');
const estudiante = document.getElementById('estudiantesSelect');
const anio = document.getElementById('selectAnio');
const carrera = document.getElementById('selectCarrera');
const btnSubmit = document.getElementById('btnSubmit');

const frmInscribirElements = {
    estudiante: false,
    anio: false,
    carrera: false,
    materias: false,
}

frmInscribir.addEventListener('submit', (e) => {
    e.preventDefault();

    const formValues = Object.values(frmInscribirElements);
    const valid = formValues.findIndex(value => value === false);

    if (valid === -1) {
        frmInscribir.submit();
    } else {
        alert('Revisar los errores');
    }
});

btnSubmit.addEventListener('click', (e) => {
    if ($('#resultadoMaterias input[type=checkbox]:checked').length === 0) {
        document.getElementById('errorMaterias').innerHTML = 'Debe seleccionar las materias';
        frmInscribirElements.materias = false;
    } else {
        document.getElementById('errorMaterias').innerHTML = '';
        frmInscribirElements.materias = true;
    }
});

function validarEstudiante(valor) {
    const estudiante = valor.value;

    if (estudiante === '') {
        document.getElementById('estudianteError').innerHTML = 'Debe seleccionar un estudiante';
        frmInscribirElements.estudiante = false;
    } else {
        document.getElementById('estudianteError').innerHTML = '';
        frmInscribirElements.estudiante = true;
    }
}

anio.addEventListener('change', (e) => {
    const anio = e.target.value;

    if (anio === '') {
        document.getElementById('anioError').innerHTML = 'Debe seleccionar un año';
        frmInscribirElements.anio = false;
    } else {
        document.getElementById('anioError').innerHTML = '';
        frmInscribirElements.anio = true;
    }
});

carrera.addEventListener('change', (e) => {
    const carrera = e.target.value;

    if (carrera === '') {
        document.getElementById('carreraError').innerHTML = 'Debe seleccionar una carrera';
        frmInscribirElements.carrera = false;
    } else {
        document.getElementById('carreraError').innerHTML = '';
        frmInscribirElements.carrera = true;
    }
});

estudiante.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    const estudiante = e.target.value;

    if (estudiante === '') {
        document.getElementById('estudianteError').innerHTML = 'Este campo es obligatorio';
        frmInscribirElements.estudiante = false;
    }
});

anio.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    const anio = e.target.value;

    if (anio === '') {
        document.getElementById('anioError').innerHTML = 'Este campo es obligatorio';
        frmInscribirElements.anio = false;
    }
});

carrera.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    const carrera = e.target.value;

    if (carrera === '') {
        document.getElementById('carreraError').innerHTML = 'Este campo es obligatorio';
        frmInscribirElements.carrera = false;
    }
});