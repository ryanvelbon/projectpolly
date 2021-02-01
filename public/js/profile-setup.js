var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementById("profileSetupModal").getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("profile-setup-prev-btn").style.display = "none";
  } else {
    document.getElementById("profile-setup-prev-btn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    submitFormAjax();
    document.getElementById("profile-setup-prev-btn").style.display = "none";
    document.getElementById("profile-setup-next-btn").style.display = "none";
    // send AJAX request
  } else {
    // document.getElementById("profile-setup-next-btn").innerHTML = "Next";
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
  }

}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementById("profileSetupModal").getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("profileSetupModal").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementById("profileSetupModal").getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementById("profileSetupModal").getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementById("profileSetupModal").getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  console.log(n);
  x[n].className += " active";
}

$(".lang-choice").click(function(event) {
  $(".lang-choice").removeClass("active");
  $(this).addClass("active");
  $("input[name='native-lang']").val($(this).data("id"));
});

$(".gender-choice").click(function(event) {
  $(".gender-choice").removeClass("active");
  $(this).addClass("active");
  $("input[name='gender']").val($(this).data("gender"));

  if($(this).hasClass("female")){
    $("#gender").val(0);
  }else if($(this).hasClass("male")){
    $("#gender").val(1);
  }
});

function submitFormAjax() {
    var form = $("#profile-setup-form");
    var url = form.attr('action');
    
    $.ajax({
      type: "POST",
      url: url,
      data: form.serialize(), // serializes the form's elements.
      success: function(data)
      {
         alert(data); // show response from the php script.
      }
    });
}