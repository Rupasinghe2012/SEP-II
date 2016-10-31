
// Ajax loading indicator
$('.ajax-loader').html('<a><img src="/images/ajax_loader.gif"></img>Loading</a>');

$(document).ajaxStart(function() {
  $(".ajax-loader").show();
});

$(document).ajaxStop(function() {
  $(".ajax-loader").hide();
});

function validate() {
  $('#error-container').html('');
  if (($("input[type='radio'][name='choice']:checked").val() == undefined)) {
    $('#error-container').html('Please select the report to generate');
    return false;
  }
  if (($("#startDate").val() == '')) {
    $('#error-container').html('Please enter the start date');
    return false;
  }
  if (($("#endDate").val() == '')) {
    $('#error-container').html('Please enter the end date');
    return false;
  }

  var s = new Date ($("#startDate").val());
  var e = new Date ($("#endDate").val());
  if (s > e) {
    $('#error-container').html('Please enter valid dates');
    return false;
  }
/*
  var diff = new Date(e-s);
  var interval = $("#interval").val();

  if (interval=='Daily' && (diff)/1000/60/60/24<1) {
    $('#error-container').html('Please enter valid dates');
    return false;
  }

  if (interval=='Weekly' && diff/1000/60/60/24<7) {
    $('#error-container').html('Please enter valid dates');
    return false;
  }

  if (interval=='Monthly' && s-e<30) {
    $('#error-container').html('Please enter valid dates');
    return false;
  }

  if (interval=='Yearly' && s-e<356) {
    $('#error-container').html('Please enter valid dates');
    return false;
  }
*/
  return true;
}

function generateReport() { 
  if (!validate())
    return false;

  var choice = $("input[type='radio'][name='choice']:checked").val();
  var startDate = $("#startDate").val();
  var endDate = $("#endDate").val();
  var interval = $('#interval').val();
  var _token = $("input[type='hidden'][name='_token']").val();
  //alert(_token);
  $.ajax({
            type:"get",
            url:"/preorder/processreport",
            data: {
              choice : choice,
              startDate : startDate,
              endDate : endDate,
              interval : interval,
              //_token : _token
            },
            success:function(iData){
              if (choice=='records') {
              var body = "<table class='table table-hover table-striped'>\
                            <thead>\
                <th>Preorder ID</th>\
                <th>Name</th>\
                <th>Value</th>\
                <th>Description</th>\
                <th>Created at</th>\
                <th>Updated at</th>\
                <th></th>\
                <thead>\
                            ";
              for (var i=0; i<iData.length; i++) {
                  
                 
                 
                  body += "<tr>\
                              <td> "+ iData[i].preorder_id +" </td> \
                              <td> "+ iData[i].name +" </td>\
                              <td> "+ iData[i].customer_id +" </td>\
                              <td> "+ iData[i].description  +" </td>\
                              <td> "+ iData[i].created_at +" </td>\
                              <td> "+ iData[i].updated_at +" </td>\
                              <td> </td>\
                            </tr>    "
              }
              body += "</table>";
                $('#pdfContent').html(body);
              } else {
                $('#pdfContent').html("<div id='chart' style='height:250px;width:720px'></div><div id='donut' style='height:250px;width:500px'></div>");
                  new Morris.Bar({
                    element: 'chart',
                    data: [
                      { y: 'Completed', a : iData[0].a},
                      { y: 'Cancelled', a : iData[1].a},
                      { y: 'Pending', a : iData[3].a}
                    ],
                    xkey: 'y',
                    ykeys: ['a'],
                    labels: ['Average value'],
                    hideHover: 'false',
                  });
                  Morris.Donut({
                        element: 'donut',
                        data: [
                          {label: "Completed", value: iData[0].b},
                          {label: "Cancelled", value: iData[1].b},
                          {label: "Pending", value: iData[3].b}
                        ]
});

              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
  });    
    
  $('#anonymiser').removeClass('hidden');
  $('#btnDownload').removeClass('disabled');
}

function downloadReport() {
  xepOnline.Formatter.Format('pdfReport', {render:'download',filename:'Preorders_report'},{pageWidth:'216mm', pageHeight:'279mm'});
}

$('input:radio[name="choice"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'records') {
            $('#interval').attr('disabled', 'disabled');
        } else {
          $('#interval').removeAttr('disabled');
        }
});