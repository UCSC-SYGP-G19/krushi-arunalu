let formStepper = null;
let defaultAvatar = null;
const form = document.querySelector("form");
const emailOtpInputs = document.querySelectorAll(".email-otp input");

// Functions related to email otp
const sendOtpToEmail = async (email) => {
  let formData = new FormData;
  formData.append("email", email);
  const res = await fetch(`${URL_ROOT}/otp/sendOtpToEmail/`, {
    method: "POST",
    body: formData
  });
  if (res.status === 200) {
    toast("success", "", "OTP sent");
    data = await res.json();
    console.log(data);
    document.querySelector("input[name='email_otp_id']").value = data.id;
    document.querySelector(".otp-wrapper.email .loading").classList.add("d-none");
    document.querySelector(".otp-wrapper.email .body").classList.remove("d-none");
  } else {
    Swal.fire({
      title: "Error",
      text: "Something went wrong while sending OTP to email. Please try again later.",
      icon: "error",
      confirmButtonText: 'OK'
    });
  }
}

const clearEmailOtp = () => {
  document.querySelector(".cancel-otp.email").classList.add("d-none");
  document.querySelector("input[name='email_otp_id']").value = "";
  emailOtpInputs.forEach((input) => (input.value = ""));
  emailOtpInputs.forEach((input) => {
    input.disabled = false;
    input.classList.remove("disabled");
  });
  emailOtpInputs[0].focus();
}

const handleEmailOtp = (e) => {
  const input = e.target;
  let value = input.value;
  let isValidInput = value.match("^[0-9]{1}$");
  input.value = "";
  input.value = isValidInput ? value[0] : "";
  let fieldIndex = input.dataset.index;
  if (fieldIndex < emailOtpInputs.length - 1 && isValidInput) {
    input.nextElementSibling.focus();
  }
  if (e.key === "Backspace" && fieldIndex > 0) {
    input.previousElementSibling.focus();
  }
  if (fieldIndex == emailOtpInputs.length - 1 && isValidInput) {
    submitEmailOtp();
  }
}

const handleOnPasteEmailOtp = (e) => {
  const data = e.clipboardData.getData("text");
  const value = data.split("");
  if (value.length === emailOtpInputs.length) {
    emailOtpInputs.forEach((input, index) => (input.value = value[index]));
    submitEmailOtp();
  }
}

const submitEmailOtp = () => {
  let otp = "";
  emailOtpInputs.forEach((input) => {
    otp += input.value;
    input.disabled = true;
    input.classList.add("disabled");
  });

  document.querySelector("input[name='email_otp']").value = otp;
  document.querySelector(".cancel-otp.email").classList.remove("d-none");
}

const navigateToFormStep = (stepNumber) => {

  // Hide all form steps.
  document.querySelectorAll(".form-step").forEach((formStepElement) => {
    formStepElement.classList.add("d-none");
  });

  // Mark all form steps as unfinished.
  document.querySelectorAll(".form-stepper-list").forEach((formStepHeader) => {
    formStepHeader.classList.add("form-stepper-unfinished");
    formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
  });

  // Show the current form step (as passed to the function).
  document.querySelector("#step-" + stepNumber).classList.remove("d-none");

  const formStepCircle = document.querySelector('li[step="' + stepNumber + '"]');

  // Mark the current form step as active.
  formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
  formStepCircle.classList.add("form-stepper-active");

  /**
   * Loop through each form step circles.
   * This loop will continue up to the current step number.
   * Example: If the current step is 3,
   * then the loop will perform operations for step 1 and 2.
   */
  for (let index = 0; index < stepNumber; index++) {
    const formStepCircle = document.querySelector('li[step="' + index + '"]');
    if (formStepCircle) {
      formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
      formStepCircle.classList.add("form-stepper-completed");
    }
  }
};

const validatePassword = (pw) => {
  let errors = [];
  if (pw.length < 8) {
    errors.push("Your password must be at least 8 characters.");
  }
  if (pw.search(/[a-z]/i) < 0) {
    errors.push("Your password must contain at least one letter.");
  }
  if (pw.search(/[0-9]/) < 0) {
    errors.push("Your password must contain at least one digit.");
  }
  if (errors.length > 0) {
    Swal.fire({
      title: "Error",
      text: errors.join("\n\n"),
      icon: "error",
      confirmButtonText: "OK",
    });
    return false;
  }
  return true;
}

document.addEventListener("DOMContentLoaded", () => {
  window.onbeforeunload = () => {
    return true;
  };

  formStepper = document.querySelector("ul.form-stepper");

  const uploadBtn = document.querySelector("button.avatar-select");
  const fileInput = document.querySelector("input.avatar-input");
  const avatar = document.querySelector(".avatar-preview .avatar");

  const roleSelectionNextBtn = document.querySelector("#next-btn-0");

  const producerStep2NextBtn = document.querySelector("#next-btn-11");
  const producerStep3NextBtn = document.querySelector("#next-btn-12");
  const producerStep4NextBtn = document.querySelector("#next-btn-13");

  roleSelectionNextBtn.addEventListener("click", () => {
    let selectedRole = null;
    document.querySelectorAll("#step-0 input").forEach((input) => {
      if (input.checked) {
        selectedRole = input.value;
      }
    });

    if (selectedRole === null) {
      Swal.fire({
        title: "Error",
        text: "Please select a role to continue.",
        icon: "error",
        confirmButtonText: 'OK'
      });
      return;
    }

    if (selectedRole === "Producer") {
      formStepper.innerHTML = `
                <li class="form-stepper-active text-center form-stepper-list" step="0">
                    <a class="mx-2">
                    <span class="form-stepper-circle">
                        <span>1</span>
                    </span>
                        <div class="label">Role selection</div>
                    </a>
                </li>
                 <li class="form-stepper-unfinished text-center form-stepper-list" step="11">
                    <a class="mx-2">
                    <span class="form-stepper-circle text-muted">
                        <span>2</span>
                    </span>
                        <div class="label text-muted">Personal details</div>
                    </a>
                </li>
                <li class="form-stepper-unfinished text-center form-stepper-list" step="12">
                    <a class="mx-2">
                    <span class="form-stepper-circle text-muted">
                        <span>3</span>
                    </span>
                        <div class="label text-muted">Verification</div>
                    </a>
                </li>
                <li class="form-stepper-unfinished text-center form-stepper-list" step="13">
                    <a class="mx-2">
                    <span class="form-stepper-circle text-muted">
                        <span>4</span>
                    </span>
                        <div class="label text-muted">Login details</div>
                    </a>
                </li>
        `;11
      navigateToFormStep(11);

    } else if (selectedRole === "Manufacturer") {
      formStepper.innerHTML = `
                <li class="form-stepper-active text-center form-stepper-list" step="0">
                    <a class="mx-2">
                    <span class="form-stepper-circle">
                        <span>1</span>
                    </span>
                        <div class="label">Role selection</div>
                    </a>
                </li>
                 <li class="form-stepper-unfinished text-center form-stepper-list" step="21">
                    <a class="mx-2">
                    <span class="form-stepper-circle text-muted">
                        <span>2</span>
                    </span>
                        <div class="label text-muted">Personal details</div>
                    </a>
                </li>
                <li class="form-stepper-unfinished text-center form-stepper-list" step="22">
                    <a class="mx-2">
                    <span class="form-stepper-circle text-muted">
                        <span>3</span>
                    </span>
                        <div class="label text-muted">Company details</div>
                    </a>
                </li>
                <li class="form-stepper-unfinished text-center form-stepper-list" step="23">
                    <a class="mx-2">
                    <span class="form-stepper-circle text-muted">
                        <span>4</span>
                    </span>
                        <div class="label text-muted">Verification</div>
                    </a>
                </li>
                <li class="form-stepper-unfinished text-center form-stepper-list" step="24">
                    <a class="mx-2">
                    <span class="form-stepper-circle text-muted">
                        <span>5</span>
                    </span>
                        <div class="label text-muted">Login details</div>
                    </a>
                </li>
        `;
      navigateToFormStep(21);
    }

    formStepper.style.display = "flex";
  });
  producerStep2NextBtn.addEventListener("click", () => {
    // Validate personal details of producer
    let isSectionValid = true;
    let pName = form.querySelector('input[name="p_name"]');
    let pNic = form.querySelector('input[name="p_nic"]');
    let pDistrict = form.querySelector('select[name="p_district"]');
    let pAddress = form.querySelector('input[name="p_address"]');
    let pContactNo = form.querySelector('input[name="p_contact_no"]');
    let pEmail = form.querySelector('input[name="p_email_address"]');


    // Set all fields in section as required

    document.querySelectorAll("#step-11 input").forEach((input) => {
      input.setAttribute("required", "required");
    });

    // Apply custom validation for form fields

    pName.setAttribute("pattern", ".{5,}");
    pName.setAttribute("maxlength", "50");
    pName.setAttribute("minlength", "3");
    pName.setAttribute("title", "Name should contain at least 5 characters");

    pNic.setAttribute("pattern", "[0-9]{9}[VX]|[0-9]{12}");
    pNic.setAttribute("maxlength", "12");
    pNic.setAttribute("minlength", "10");
    pNic.setAttribute("title", "9 digits with V/X at the end or 12 digits");
    // pNic.setCustomValidity("Please enter a valid NIC number");

    pAddress.setAttribute("pattern", ".{5,}");
    pAddress.setAttribute("maxlength", "100");
    pAddress.setAttribute("minlength", "5");
    pAddress.setAttribute("title", "Address should contain at least 5 characters");

    pContactNo.setAttribute("pattern", "[+94]{3}[0-9]{9}");
    pContactNo.setAttribute("maxlength", "12");
    pContactNo.setAttribute("minlength", "12");
    pContactNo.setAttribute("title", "+94XXXXXXXXX");

    if (!pName.reportValidity() || !pNic.reportValidity() || !pDistrict.reportValidity() || !pAddress.reportValidity() || !pContactNo.reportValidity() || !pEmail.reportValidity()) {
      document.querySelector("#step-11 div").classList.add("shake");
      setTimeout(() => {
        document.querySelector("#step-11 div").classList.remove("shake");
      }, 1000);
      isSectionValid = false;
    }

    if (isSectionValid) {
      navigateToFormStep(12);

      if (form.querySelector('input[name="email_otp"]').value === "") {
        const enteredEmail = form.querySelector('input[name="p_email_address"]').value;
        let emailOtpContainer = document.querySelector("#step-12 .otp-wrapper.email");
        emailOtpContainer.querySelector(".loading").classList.remove("d-none");
        emailOtpContainer.querySelector(".body strong").innerHTML = enteredEmail;

        toast("loading", "", "Sending OTP to email", 3000);
        sendOtpToEmail(enteredEmail);
      }
    }

  });
  producerStep3NextBtn.addEventListener("click", () => {
    // Validate OTP fields
    let pEmailOtp = form.querySelector("input[name='email_otp']");
    console.log(pEmailOtp.value);

    const loadLastPage = () => {
      const userName = form.querySelector('input[name="p_name"]').value;
      const userInfo = form.querySelector('input[name="p_email_address"]').value + " | " + form.querySelector('input[name="p_contact_no"]').value;
      defaultAvatar = "https://api.dicebear.com/6.x/initials/svg?seed=" + userName.replace(" ", "+");
      document.querySelector("#step-13 .user-name").innerHTML = userName;
      document.querySelector("#step-13 .user-info").innerHTML = userInfo;

      navigateToFormStep(13);

      avatar.style.background = `url(${defaultAvatar}) center center/cover`;

      const avatarUploadBtn = document.querySelector("button.avatar-upload");
      avatarUploadBtn.setAttribute("disabled", "disabled");
      avatarUploadBtn.setAttribute("title", "Please pick a new image first before uploading");
    }

    if (pEmailOtp.value.length !== 6) {
      Swal.fire({
        title: "Warning",
        text: "Are you sure you want to continue without confirming your email?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
      }).then((result) => {
        if (result.isConfirmed) {
          loadLastPage();
        }
      });
    } else {
      loadLastPage();
    }
  });

  producerStep4NextBtn.addEventListener("click", () => {
    // Validate personal details of producer
    let isSectionValid = true;
    let pPassword = form.querySelector('input[name="p_password"]');
    let pConfirmPassword = form.querySelector('input[name="p_confirm_password"]');

    pPassword.setAttribute("required", "required");

    // set regex pattern so that Password should contain at least 8 characters, at least 1 letter and 1 digit
    pPassword.setAttribute("pattern", "(?=.*\\d)(?=.*[a-zA-Z]).{8,}");
    pPassword.setAttribute("maxlength", "50");
    pPassword.setAttribute("minlength", "8");
    pPassword.setAttribute("title", "Password should contain at least 8 characters, at least 1 letter and 1 digit");

    // pPassword.setCustomValidity("Password should contain at least 8 characters, at least 1 letter and 1 digit");
    pConfirmPassword.setAttribute("required", "required");
    pConfirmPassword.setAttribute("maxlength", "50");
    pConfirmPassword.setAttribute("minlength", "8");

    if (!pPassword.reportValidity() || !validatePassword(pPassword.value)) {
      document.querySelector("#step-13 div.passwords").classList.add("shake");
      setTimeout(() => {
        document.querySelector("#step-13 div.passwords").classList.remove("shake");
      }, 1000);
      return;
    }

    if (!pConfirmPassword.reportValidity()) {
      document.querySelector("#step-13 div.passwords").classList.add("shake");
      setTimeout(() => {
        document.querySelector("#step-13 div.passwords").classList.remove("shake");
      }, 1000);
      return;
    }

    if (pPassword.value !== pConfirmPassword.value) {
      isSectionValid = false;
      pConfirmPassword.setCustomValidity("Passwords do not match");
      Swal.fire({
        title: "Warning",
        text: "Passwords do not match",
        icon: "warning",
      });
      return;
    }

    if (isSectionValid) {
      Swal.fire({
        title: "Success",
        text: "Form submitted successfully",
        icon: "success",
      });
    }

  });

  document.querySelectorAll(".btn-navigate-form-step.prev-btn").forEach((formNavigationBtn) => {
    formNavigationBtn.addEventListener("click", () => {
      console.log(formStepper);
      const stepNumber = parseInt(formNavigationBtn.getAttribute("step_number"));

      if (stepNumber === 0) {
        formStepper.style.display = "none";
      }

      navigateToFormStep(stepNumber);
    });
  });

  emailOtpInputs.forEach((input, index) => {
    input.dataset.index = index;
    input.addEventListener("keyup", handleEmailOtp);
    input.addEventListener("paste", handleOnPasteEmailOtp);
  })

  uploadBtn.addEventListener("click", () => {
    fileInput.click();
  });

  fileInput.addEventListener("change", event => {
    const file = event.target.files[0];
    const avatarUploadBtn = document.querySelector("button.avatar-upload");

    if (file === undefined) {
      avatar.style.background = `url(${defaultAvatar}) center center/cover`;
      avatarUploadBtn.classList.add("disabled");
      avatarUploadBtn.setAttribute("disabled", "disabled");
      return;
    }

    // if file is a blob
    if (file.type !== "image/png" && file.type !== "image/jpeg" && file.type !== "image/jpg") {
      Swal.fire({
        title: "Error",
        text: "Please select a valid image file",
        icon: "error",
        confirmButtonText: 'Ok',
      });

    } else {
      const reader = new FileReader();
      reader.readAsDataURL(file);

      reader.onloadend = () => {
        avatar.setAttribute("aria-label", file.name);
        avatar.style.background = `url(${reader.result}) center center/cover`;

        avatarUploadBtn.classList.remove("disabled");
        avatarUploadBtn.classList.add("btn-primary-dark", "text-white");
        avatarUploadBtn.removeAttribute("disabled");
        producerStep4NextBtn.classList.add("disabled");
        producerStep4NextBtn.setAttribute("disabled", "disabled");
      };
    }
  });

});
