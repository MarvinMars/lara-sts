// Import external dependencies
import 'jquery';
window.laroute = require('./laroute');
import 'bootstrap/dist/js/bootstrap';
import 'iframe-resizer';
import 'select2';
//Import Router
import Router from './util/Router';
//Import local dependencies
import common from './routes/common';

/** Populate Router instance with DOM routes */
const routes = new Router({
    // All pages
    common,
});


// Load Events
jQuery(document).ready(() => routes.loadEvents());