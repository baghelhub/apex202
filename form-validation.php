<!DOCTYPE html>
<html>
<head>
  <title>Form Validation</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
<body>
    <div class="container">
    <div class="row">
        <h3>Form Validation For Testing<h3>
  <form id="myForm">
     <div class="mb-3 mt-3">
        <label for="Name">Enter Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name">
        <span style="color:red;" id="nameError" class="error"></span>
      </div>
      <div class="mb-3 mt-3">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email">
        <span style="color:red;" id="emailError" class="error"></span>
      </div>
      <div class="mb-3">
        <label for="Mobile">Mobile:</label>
        <input type="text" class="form-control" id="mobile" placeholder="Enter mobile">
        <span style="color:red;" id="mobileError" class="error"></span>
      </div>
      <div class="mb-3">
        <label for="Zipcode">Zipcode:</label>
        <input type="text" class="form-control" id="zipcode" placeholder="Enter zipcode">
        <span style="color:red;" id="zipcodeError" class="error"></span>
      </div>
      <button type="button" id="subbtn" class="btn btn-primary">Click</button>
  </form>
  <div>
</div>

  <script>
    
    document.getElementById("subbtn").addEventListener("click", function() {
       
      // Clear previous error messages
        var errorSpans = document.querySelectorAll(".error");
        for (var i = 0; i < errorSpans.length; i++) {
            errorSpans[i].textContent = "";
        }

        // Get form values
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var mobile = document.getElementById("mobile").value;
        var zipcode = document.getElementById("zipcode").value;

        // Name Validation (Non-empty)
        var nPattern = /^[A-Za-z]+$/;
        if (name.trim() === ""|| !nPattern.test(name) ) {
            document.getElementById("nameError").textContent = "Please enter a valid name.";
            return;
        }

        // Email Validation
        var ePattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (name.trim() === ""|| !ePattern.test(email)) {
            document.getElementById("emailError").textContent = "Please enter a valid email address.";
            return;
        }

        // Mobile Validation 
        var mPattern = /^[6-9]\d{9}$/;
        var consecutiveRepeatPattern = /(\d)\1{4}/; // Matches 4 consecutive repeating digits
        if (name.trim() === ""|| !mPattern.test(mobile) || consecutiveRepeatPattern.test(mobile)) {
            document.getElementById("mobileError").textContent = "Please enter a valid mobile number .";
            return;
        }

        // Zipcode Validation 
        var zPattern = /^[1-9]\d{5}$/;
        if (name.trim() === ""|| !zPattern.test(zipcode)) {
            document.getElementById("zipcodeError").textContent = "Please enter a valid zipcode.";
            return;
        }

        alert("Form is valid you can try this");
    });
  </script>
</body>
</html>
