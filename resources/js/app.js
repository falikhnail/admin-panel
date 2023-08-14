import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import '../lib/bootstrap/js/bootstrap.js'
import '../lib/bootstrap/js/bootstrap.min.js'
import  '../lib/jquery/jquery';
import '../lib/jquery/jquery.min.js';

window.Alpine = Alpine;
Alpine.plugin(collapse);

Alpine.start();
