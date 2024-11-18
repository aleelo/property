<script type="text/javascript">
var fnLicenseParams = {};
var admin_url = $('input[name="site_url"]').val();

(function($) {
	"use strict";
  $('#transaction_licenses .select2').select2();
  setDatePicker("#transaction_licenses #from_date");
  setDatePicker("#transaction_licenses #to_date");
  
	fnLicenseParams = {
      "status": '#transaction_licenses [name="status"]',
      "from_date": '#transaction_licenses [name="from_date"]',
      "to_date": '#transaction_licenses [name="to_date"]',
    };

	$('#transaction_licenses select[name="status"]').on('change', function() {
	    init_fe_licenses_table();
	});

	$('#transaction_licenses input[name="from_date"]').on('change', function() {
		init_fe_licenses_table();
	});

	$('#transaction_licenses input[name="to_date"]').on('change', function() {
		init_fe_licenses_table();
	});

  init_fe_licenses_table();

  $('#transaction_licenses input[name="mass_convert"]').on('change', function() {
    if($('#transaction_licenses input[name="mass_convert"]').is(':checked') == true){
      $('#transaction_licenses input[name="mass_delete_convert"]').prop( "checked", false );
    }
  });

  $('#transaction_licenses input[name="mass_delete_convert"]').on('change', function() {
    if($('#transaction_licenses input[name="mass_delete_convert"]').is(':checked') == true){
      $('#transaction_licenses input[name="mass_convert"]').prop( "checked", false );
    }
  });
  
  // On mass_select all select all the availble rows in the tables.
  $("body").on('change', '#transaction_licenses #mass_select_all', function () {
      var to, rows, checked;
      to = $(this).data('to-table');

      rows = $('.table-' + to).find('tbody tr');
      checked = $(this).prop('checked');
      $.each(rows, function () {
          $($(this).find('td').eq(0)).find('input').prop('checked', checked);
      });
  });
})(jQuery);

function init_fe_licenses_table() {
"use strict";

  if ($.fn.DataTable.isDataTable('.table-licenses')) {
    $('.table-licenses').DataTable().destroy();
  }
  initDataTable('.table-licenses', admin_url + 'accounting/fe_licenses_table', [0], [0], fnLicenseParams, [1, 'desc'], [11]);
}


function licenses_transaction_bulk_actions(){
    "use strict";
    $('#licenses_bulk_actions').modal('show');
}

// licenses bulk actions action
function licenses_bulk_action(event) {
  "use strict";
    if (confirm_delete()) {
        var ids = [],
            data = {};
            data.type = $('#transaction_licenses input[name="bulk_actions_type"]').val();
            data.mass_convert = $('#transaction_licenses input[name="mass_convert"]').prop('checked');
            data.mass_delete_convert = $('#transaction_licenses input[name="mass_delete_convert"]').prop('checked');

        var rows = $('.table-licenses').find('tbody tr');

        $.each(rows, function() {
            var checkbox = $($(this).find('td').eq(0)).find('input');
            if (checkbox.prop('checked') === true) {
                ids.push(checkbox.val());
            }
        });
        data.ids = ids;
        $(event).addClass('disabled');
        setTimeout(function() {
            $.post(admin_url + 'accounting/transaction_bulk_action', data).done(function() {
               window.location.reload();
            });
        }, 200);
    }
}

// Will give alert to confirm delete
function confirm_delete() {
    var message = 'Are you sure you want to perform this action?';

    // Clients area
    if (typeof(app) != 'undefined') {
        message = app.lang.confirm_action_prompt;
    }

    var r = confirm(message);
    if (r == false) { return false; }
    return true;
}
</script>