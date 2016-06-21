jQuery(document).ready(function() {
        jQuery('<div class="bl-pageloader"></div>').prependTo('body');
});
jQuery(window).load(function() {
    jQuery(".bl-pageloader").fadeOut("slow");;
});