var description = document.getElementById("Des");

function addRequest() {

  var flag = false;
 
  if (description.value.length > 1000) {
    alert("You can not write more than 1000 character!");
  } else if (description.value == '') {
    alert("Write the request description.");
  } else {
    flag = true;
  }

  var attachment;
  var f;

  if (flag) {
    attachment = false;
    f = document.getElementById("myfile");

      if (f.files.length > 2) {
        alert("Upload at most 2 files");
      } else {
        attachment = true;
      }

    if (attachment) {
      document.form.submit();
    }
  }
  
}
