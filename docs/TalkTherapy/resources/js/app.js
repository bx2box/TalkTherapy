import './bootstrap';

// Importa la librería de Vue.js
import Vue from 'vue';

// Importa el componente de la barra de progreso de Vue
import VueProgressBar from 'vue-progressbar';

// Configura la barra de progreso de Vue
const options = {
    color: '#3498db',
    failedColor: '#ff0000',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
};

// Registra el componente de la barra de progreso de Vue
Vue.use(VueProgressBar, options);

// Crea una nueva instancia de Vue
const app = new Vue({
    // Define el elemento HTML donde se montará la aplicación
    el: '#app',

    // Define los datos de la aplicación
    data: {
        // Define si la barra de progreso de Vue está activa o no
        progressbarActive: false
    },

    // Define los métodos de la aplicación
    methods: {
        // Activa la barra de progreso de Vue
        activateProgressBar() {
            this.progressbarActive = true;
        },

        // Desactiva la barra de progreso de Vue
        deactivateProgressBar() {
            this.progressbarActive = false;
        }
    }
});
