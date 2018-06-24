import "bootstrap-datepicker";
import "bootstrap-datepicker/dist/locales/bootstrap-datepicker.fr.min";
// var dp = require('bootstrap-datepicker');

$.fn.datepicker.defaults.format = "dd/mm/yyyy";
$('.datepicker').datepicker({
    language: 'fr',
    calendarWeeks: true,
    clearBtn: true,
    todayBtn: true,
    todayHighlight: true,
    weekStart: 1,
});
