var App = {
  init: function () {
    var note_form = document.getElementById('note-form');
    var delete_form = document.querySelector('[data-confirm]');
    var dirty = false;
    var leaving = false;
    if (note_form) {
      var content = document.getElementById('note-content');
      var count = document.getElementById('character-count');
      var update_count = function () { count.textContent = content.value.length + ' karakter'; };
      update_count();
      note_form.addEventListener('input', function () {
        dirty = true;
        document.getElementById('save-status').textContent = 'Nem mentett módosítások';
        update_count();
      });
      note_form.addEventListener('change', function () { dirty = true; });
      note_form.addEventListener('submit', function () { leaving = true; });
      document.addEventListener('keydown', function (event) {
        if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 's') {
          event.preventDefault();
          if (note_form.requestSubmit) { note_form.requestSubmit(); }
          else if (note_form.checkValidity()) { leaving = true; note_form.submit(); }
        }
      });
      window.addEventListener('beforeunload', function (event) {
        if (dirty && !leaving) { event.preventDefault(); event.returnValue = ''; }
      });
    }
    if (delete_form) {
      delete_form.addEventListener('submit', function (event) {
        if (!window.confirm(delete_form.getAttribute('data-confirm'))) { event.preventDefault(); }
        else { leaving = true; }
      });
    }
  }
};
