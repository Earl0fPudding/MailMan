$(document).ready(function(){
var $selectboxes = $('select').formSelect();
$selectboxes.each((index) => {
    var self = M.FormSelect.getInstance($selectboxes[index]);
    $(self.input).focus(() => {
        $(self.wrapper).prevAll("i.prefix").addClass('active');
    });
    $(self.dropdownOptions).focus(() => {
        $(self.wrapper).prevAll("i.prefix").addClass('active');
    });
    $(self.input).focusout(() => {
        $(self.wrapper).prevAll("i.prefix").removeClass('active');
    });
});
});
