/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
import $ from 'jquery';
window.jQuery = $;
window.$ = $;
import 'select2';                       // globally assign select2 fn to $ element
import 'select2/dist/css/select2.css';  // optional if you have css loader
require('summernote/dist/summernote-bs4.css');
require('summernote/dist/summernote-bs4');

var AddButton       = $("#addfield"); //Add button ID
$(AddButton).click(function (e) { //on add input button click
    var InputsWrapper = $("#InputsWrapper .row").length;
    $("#InputsWrapper").append('<div class="row"><div class="col-2"><div class="form-group mb-3"><div class="input-group input-group-alternative"><input class="form-control score" name="scoring['+ InputsWrapper +'][score]" placeholder="Score" type="text"></div></div></div><div class="col-9"><div class="form-group mb-3"><div class="input-group input-group-alternative"><input class="form-control description" name="scoring['+ InputsWrapper +'][description]" placeholder="Description" type="text"></div></div></div><div class="col-1"><button class="btn btn-icon btn-2 btn-danger removeclass">x</button></div></div>');
});

$("body").on("click",".removeclass", function(e) { //user click on remove text
    if( $("#InputsWrapper .row").length >= 1 ) {
        $(this).parent().closest('.row').remove(); //remove text box
        var x = 0;
        $("#InputsWrapper .row").each(function() {
            var inputScore = $(this).find("input.score");
            inputScore.attr('name', 'scoring['+x+'][score]');
            var inputDescription = $(this).find("input.description");
            inputDescription.attr('name', 'scoring['+x+'][description]');
            x++;
        });
    }
    if( $("#dd-list").length ) {
        $(this).closest('.dd-item').remove();
    }
    return false;
});

$(document).ready(function() {
    $('.select2').select2();
});