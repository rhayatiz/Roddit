<?php 
$page = 'new-message';
require('shared/messagerie-header.php');
?>

<div class="form-group row m-2">
    <h4>Nouveau message</h4>
    <!-- Destinataire -->
    <div class="col-12 p-0">
        <div class="form-group">
            <input class="form-control bs-autocomplete p-4" id="ac-demo" value=""
                placeholder="Destinataire ..." type="text" 
                data-hidden_field_id="user-id" data-item_id="id" 
                data-item_label="username" autocomplete="off">
        </div>
    </div>
    <!-- Fin destinataire -->
    <input class="form-control p-4 mt-2" type="text" placeholder="Sujet">
    <textarea class="form-control mt-2" name="" id="" cols="30" rows="10"></textarea>

    <button class="btn btn-sm btn-primary w-100 mt-2">Envoyer</button>

</div>
<?php include('shared/messagerie-footer.php');?>
<script>
    // Autocompletion
    // https://codepen.io/massimo-cassandro/pen/NqRmMe
    $.widget("ui.autocomplete", $.ui.autocomplete, {
        _renderMenu: function(ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked  bs-autocomplete-menu");
            $.each(items, function(index, item) {
                that._renderItemData(ul, item);
            });
        },

        _resizeMenu: function() {
            var ul = this.menu.element;
            ul.outerWidth(Math.min(
                // Firefox wraps long text (possibly a rounding bug)
                // so we add 1px to avoid the wrapping (#7513)
                ul.width("").outerWidth() + 1,
                this.element.outerWidth()
            ));
        }
    });

    (function() {
        "use strict";
        var users = [];

        $('.bs-autocomplete').each(function() {
            var _this = $(this),
                _data = _this.data(),
                _hidden_field = $('#' + _data.hidden_field_id);

            _this.after('<div class="bs-autocomplete-feedback form-control-feedback"><div class="loader">Loading...</div></div>')
                .parent('.form-group').addClass('has-feedback');

            var feedback_icon = _this.next('.bs-autocomplete-feedback');
            feedback_icon.hide();

            _this.autocomplete({
                minLength: 2,
                autoFocus: true,

                // quand l'utilisateur ecrit dans l'input
                source: function(request, response) {
                    fetch("api/users")
                        .then(res => res.json())
                        .then(data => users = data);

                    var _regexp = new RegExp(request.term, 'i');
                    var data = users.filter(function(item) {
                        return item.username.match(_regexp);
                    });
                    response(data);
                },

                search: function() {
                    feedback_icon.show();
                    _hidden_field.val('');
                },

                response: function() {
                    feedback_icon.hide();
                },

                focus: function(event, ui) {
                    _this.val(ui.item[_data.item_label]);
                    event.preventDefault();
                },

                select: function(event, ui) {
                    console.log(_this);
                    _this.val(ui.item[_data.item_label]);
                    _hidden_field.val(ui.item[_data.item_id]);
                    event.preventDefault();
                }
                })
                .data('ui-autocomplete')._renderItem = function(ul, item) {
                return $('<li></li>')
                    .data("item.autocomplete", item)
                    .append('<a>' + item[_data.item_label] + '</a>')
                    .appendTo(ul);
                };
            // end autocomplete
        });
    }
)();
</script>

