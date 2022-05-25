var script = document.createElement('script');
script.src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js";

function approve(id) {
  $.ajax({
    url: "StatusUpdate.php",
    type: "POST",
    data: { REQID: id, status: "Approved" },
    dataType: "text",
    success: function (result) {
      console.log(result);
      $("#Cstatus" + id).html("<span class='green-dot'></span> Approved");
      $("#B" + id).empty();
      $("#B" + id).html('<input class="buttonnD" type="button" value="Decline" onClick="decline(' + id + ')" >');
      $("#INp").attr('style', "background-color: white;");
    }
  });
}

function decline(id) {
  $.ajax({
    url: "StatusUpdate.php",
    type: "POST",
    data: { REQID: id, status: "Declined" },
    dataType: "text",

    success: function (result) {
      console.log(result);
      $("#Cstatus" + id).html("<span class='red-dot'></span> Declined");
      $("#B" + id).empty();
      $("#B" + id).html('<input class="buttonnA" type="button" value="Approve" onClick="approve(' + id + ')"> ');
      $("#INp").attr('style', "background-color: white;");
    }
  });
}

