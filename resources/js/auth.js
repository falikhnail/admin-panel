import './app';
import '../css/app.css';
import '../css/backend.css';
import '../lib/bootstrap/css/bootstrap.min.css';
import '../lib/bootstrap/js/bootstrap.bundle.min.js';

// Enable tooltips everywhere
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new coreui.Tooltip(tooltipTriggerEl)
})
