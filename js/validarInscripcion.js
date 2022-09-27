const formInscripcion = document.getElementById('frmInscripcion');
const carrera = document.getElementById('carrera');
const sede = document.getElementById('sedes');
const anio = document.getElementById('anio');
const btnEnviar = document.getElementById('btnEnviar');

const elements = {
    carrera: false,
    sede: true,
    anio: false,
    materias: false,
}

btnEnviar.addEventListener('click', (e) => {
    if ($('input[type=checkbox]:checked').length === 0) {
        elements.materias = false;
    } else {
        elements.materias = true;
    }
})

formInscripcion.addEventListener('submit', (e) => {
    e.preventDefault();

    const elementsValues = Object.values(elements);
    const valid = elementsValues.findIndex(value => value === false);

    if (valid === -1) {
        formInscripcion.submit();
    } else {
        alert('Revisar los errores o seleccionar las materias');
    }
});

carrera.addEventListener('change', (e) => {
    const carrera = e.target.value;

    if (carrera === '') {
        document.getElementById('carreraError').innerHTML = 'Debe seleccionar una carrera';
        elements.carrera = false;
    } else {
        document.getElementById('carreraError').innerHTML = '';
        elements.carrera = true;
    }

});

sede.addEventListener('change', (e) => {
    const sede = e.target.value;

    if (sede === '') {
        document.getElementById('sedeError').innerHTML = 'Debe seleccionar una sede';
        elements.sede = false;
    } else {
        document.getElementById('sedeError').innerHTML = '';
        elements.sede = true;
    }
});

anio.addEventListener('change', (e) => {
    const anio = e.target.value;

    if (anio === '') {
        document.getElementById('anioError').innerHTML = 'Debe seleccionar un año de cursado';
        elements.anio = false;
    } else {
        document.getElementById('anioError').innerHTML = '';
        elements.anio = true;
    }
});

//FORM INVALIDO

carrera.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value === '') {
        carrera.focus();
        document.getElementById('carreraError').innerHTML = 'Este campo es obligatorio';
        elements.carrera = false;
    }

});

sede.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value === '') {
        sede.focus();
        document.getElementById('sedeError').innerHTML = 'Este campo es obligatorio';
        elements.carrera = false;
    }

});

anio.addEventListener('invalid', (e) => {
    e.preventDefault();
    e.target.setCustomValidity('');

    if (e.target.value === '') {
        anio.focus();
        document.getElementById('anioError').innerHTML = 'Este campo es obligatorio';
        elements.carrera = false;
    }

});
