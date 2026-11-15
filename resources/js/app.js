import './jquery-global';
import select2 from 'select2';
import 'select2/dist/css/select2.css';
import duallistbox from 'bootstrap4-duallistbox';
import 'bootstrap4-duallistbox/dist/bootstrap-duallistbox.css';

const $ = window.jQuery;

// Приєднання плагінів до jQuery
if (typeof select2 === 'function') {
    select2(window, $);
}
if (typeof duallistbox === 'function') {
    duallistbox(window, $);
}

$(function () {
    $('#filters').select2({ width: '340px', placeholder: 'Оберіть мітки' });
    $('#platforms').select2({ width: '340px', placeholder: 'Оберіть платформи' });

    if ($('#duallist').length) {
        $('#duallist').bootstrapDualListbox({
            nonSelectedListLabel: 'Доступні мітки',
            selectedListLabel: 'Обрані мітки',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: false,
            infoText: 'Усього {0}',
            filterPlaceHolder: 'Пошук',
        });
    }
});
