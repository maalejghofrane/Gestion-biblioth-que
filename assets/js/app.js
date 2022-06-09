/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
let body = $("body");
console.log(body);
console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
 $('#okey').hide();

$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideDown(5000);
    });
    $("#stop").click(function(){
        $("#panel").stop();
    });
});
$(document).ready(function(){
    $("p").click(function(){
        $(this).hide();
    });
});
// $(document).ready(function(){
//     $("button").click(function(){
//         $("div").animate({left: '250px'});
//     });
// });

// $(document).ready(function(){
//     $("button").click(function(){
//         var div = $("div");
//         div.animate({left: '100px'}, "slow");
//         div.animate({fontSize: '3em'}, "slow");
//     });
// });

// $(document).ready(function(){
//     $("#flip").click(function(){
//         $("#panel").slideDown("slow");
//     });
// });
var $collectionHolder;

// setup an "add a tag" link
var $addTagButton = $('<button type="button" class="add_Tag_link">ajouter un eleve</button>');
var $newLinkLi = $('<li></li>').append($addTagButton);

$(document).ready(function() {
    // Get the ul that holds the collection of tags
    $collectionHolder = $('ul.eleves');

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTagButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });
});
function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}

