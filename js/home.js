function validateSignUpHandlerD(submitBtn) {
	const email_pattern =
		/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	const mobile_pattern = /^[1-9]{1}[0-9]{9}$/i;
	const first_name = getValue("first_name");
	const last_name = getValue("last_name");
	const username = getValue("username");
	const email = getValue("email");
	const phone = getValue("phone");
	const password = getValue("password");
	const confirm_password = getValue("confirm_password");
	submitBtn.querySelector(".loader").style.display = "inline-block";
	submitBtn.setAttribute("disabled", true);
	if (first_name.trim() == "") {
		setHtml("first_name_error", "Required");
		addClass(document.getElementById("first_name"), "input_error");
		setTimeout(function () {
			setHtml("first_name_error", "");
			removeClass(document.getElementById("first_name"), "input_error");
		}, 5000);
		document.getElementById("first_name").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (last_name.trim() == "") {
		setHtml("last_name_error", "Required");
		addClass(document.getElementById("last_name"), "input_error");
		setTimeout(function () {
			setHtml("last_name_error", "");
			removeClass(document.getElementById("last_name"), "input_error");
		}, 5000);
		document.getElementById("last_name").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (username.trim() == "") {
		setHtml("username_error", "Required");
		addClass(document.getElementById("username"), "input_error");
		setTimeout(function () {
			setHtml("username_error", "");
			removeClass(document.getElementById("username"), "input_error");
		}, 5000);
		document.getElementById("username").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (email.trim() == "") {
		setHtml("email_error", "Required");
		addClass(document.getElementById("email"), "input_error");
		setTimeout(function () {
			setHtml("email_error", "");
			removeClass(document.getElementById("email"), "input_error");
		}, 5000);
		document.getElementById("email").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	} else if (!email_pattern.test(email)) {
		setHtml("email_error", "Invalid");
		addClass(document.getElementById("email"), "input_error");
		setTimeout(function () {
			setHtml("email_error", "");
			removeClass(document.getElementById("email"), "input_error");
		}, 5000);
		document.getElementById("email").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (phone.trim() == "") {
		setHtml("phone_error", "Required");
		addClass(document.getElementById("phone"), "input_error");
		setTimeout(function () {
			setHtml("phone_error", "");
			removeClass(document.getElementById("phone"), "input_error");
		}, 5000);
		document.getElementById("phone").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	} else if (!mobile_pattern.test(phone)) {
		setHtml("phone_error", "Invalid");
		addClass(document.getElementById("phone"), "input_error");
		setTimeout(function () {
			setHtml("phone_error", "");
			removeClass(document.getElementById("phone"), "input_error");
		}, 5000);
		document.getElementById("phone").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (password.trim() == "") {
		setHtml("password_error", "Required");
		addClass(document.getElementById("password"), "input_error");
		setTimeout(function () {
			setHtml("password_error", "");
			removeClass(document.getElementById("password"), "input_error");
		}, 5000);
		document.getElementById("password").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (confirm_password.trim() == "") {
		setHtml("confirm_password_error", "Required");
		addClass(document.getElementById("confirm_password"), "input_error");
		setTimeout(function () {
			setHtml("confirm_password_error", "");
			removeClass(document.getElementById("confirm_password"), "input_error");
		}, 5000);
		document.getElementById("confirm_password").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	} else if (password.trim() != confirm_password.trim()) {
		setHtml("confirm_password_error", "Passwords does not match");
		addClass(document.getElementById("confirm_password"), "input_error");
		setTimeout(function () {
			setHtml("confirm_password_error", "");
			removeClass(document.getElementById("confirm_password"), "input_error");
		}, 5000);
		document.getElementById("confirm_password").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	$.post(
		site_url("/home/check_user_exist"),
		{
			username: username,
			email: email,
			phone: phone,
		},
		function (data) {
			if (data == "username") {
				setHtml("username_error", "Username already exist");
				addClass(document.getElementById("username"), "input_error");
				setTimeout(function () {
					setHtml("username_error", "");
					removeClass(document.getElementById("username"), "input_error");
				}, 5000);
				document.getElementById("username").focus();
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
				return false;
			} else if (data == "email") {
				setHtml("email_error", "Email already exist");
				addClass(document.getElementById("email"), "input_error");
				setTimeout(function () {
					setHtml("email_error", "");
					removeClass(document.getElementById("email"), "input_error");
				}, 5000);
				document.getElementById("email").focus();
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
				return false;
			} else if (data == "phone") {
				setHtml("phone_error", "Phone already exist");
				addClass(document.getElementById("phone"), "input_error");
				setTimeout(function () {
					setHtml("phone_error", "");
					removeClass(document.getElementById("phone"), "input_error");
				}, 5000);
				document.getElementById("phone").focus();
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
				return false;
			} else {
				document.signup_form.submit();
			}
			return false;
		}
	);
	return false;
}
//Root Login
function validateLoginHandlerD(submitBtn) {
	const username = getValue("login_username");
	const password = getValue("login_password");

	submitBtn.querySelector(".loader").style.display = "inline-block";
	submitBtn.setAttribute("disabled", true);
	if (username.trim() == "") {
		setHtml("login_username_error", "Enter User Id");
		addClass(document.getElementById("login_username"), "input_error");
		setTimeout(function () {
			setHtml("login_username_error", "");
			removeClass(document.getElementById("login_username"), "input_error");
		}, 5000);
		document.getElementById("login_username").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (password.trim() == "") {
		setHtml("login_password_error", "Enter Password");
		addClass(document.getElementById("login_password"), "input_error");
		setTimeout(function () {
			setHtml("login_password_error", "");
			removeClass(document.getElementById("login_password"), "input_error");
		}, 5000);
		document.getElementById("login_password").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	var url =  apiUrl+'/Apis/UserLoginAction';
	var otpUrl = apiUrl+'/Home/otpAuth';
	var data = {
		user_id: username,password:password,logintype:'web'
	};
	//alert(JSON.stringify(data)); return false;
	fetch(url, {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(data),
	})
	.then(function (res) {
			return res.text();
		})
	.then(function (data) {
			data = JSON.parse(data);
			//alert(data); return false;
			if (data.success ==1) {
				document.login_form.submit();
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
			}
			else if(data.success ==2){
				window.location.href = otpUrl+'/'+data.user_id;
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
				return false;
			}
			 else{
				setHtml("login_errors", "User does not exist");
				setTimeout(function () {
					setHtml("login_errors", "");
				}, 3000);
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
				return false;
			}
		})
       	
}

//Scientist Login
function validateLoginHandlerSD(submitBtn) {
	const username = getValue("login_username");
	const password = getValue("login_password");

	submitBtn.querySelector(".loader").style.display = "inline-block";
	submitBtn.setAttribute("disabled", true);
	if (username.trim() == "") {
		setHtml("login_username_error", "Enter User Id");
		addClass(document.getElementById("login_username"), "input_error");
		setTimeout(function () {
			setHtml("login_username_error", "");
			removeClass(document.getElementById("login_username"), "input_error");
		}, 5000);
		document.getElementById("login_username").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (password.trim() == "") {
		setHtml("login_password_error", "Enter Password");
		addClass(document.getElementById("login_password"), "input_error");
		setTimeout(function () {
			setHtml("login_password_error", "");
			removeClass(document.getElementById("login_password"), "input_error");
		}, 5000);
		document.getElementById("login_password").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	var url =  apiUrl+'/Apis/UserLoginAction';
	var otpUrl = apiUrl+'/Home/otpAuth';
	var data = {
		user_id: username,password:password,logintype:'web'
	};
	//alert(JSON.stringify(data)); return false;
	fetch(url, {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(data),
	})
	.then(function (res) {
			return res.text();
		})
	.then(function (data) {
			data = JSON.parse(data);
			//alert(JSON.stringify(data)); return false;
			if (data.success ==1) {
				document.Slogin_form.submit();
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
			}
			else if(data.success ==2){
				window.location.href = otpUrl+'/'+data.user_id;
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
				return false;
			}
			 else if(data.success ==0){
				setHtml("login_errors", "User does not exist");
				setTimeout(function () {
					setHtml("login_errors", "");
				}, 3000);
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
				return false;
			}
		})
        	
}
//BirdID Login
function validateLoginHandlerBID(submitBtn) {
	const username = getValue("login_usernameBID");
	const password = getValue("login_passwordBID");

	submitBtn.querySelector(".loader").style.display = "inline-block";
	submitBtn.setAttribute("disabled", true);
	if (username.trim() == "") {
		setHtml("login_username_errorBID", "Enter User Id");
		addClass(document.getElementById("login_usernameBID"), "input_error");
		setTimeout(function () {
			setHtml("login_username_errorBID", "");
			removeClass(document.getElementById("login_usernameBID"), "input_error");
		}, 5000);
		document.getElementById("login_usernameBID").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	if (password.trim() == "") {
		setHtml("login_password_errorBID", "Enter Password");
		addClass(document.getElementById("login_passwordBID"), "input_error");
		setTimeout(function () {
			setHtml("login_password_errorBID", "");
			removeClass(document.getElementById("login_passwordBID"), "input_error");
		}, 5000);
		document.getElementById("login_passwordBID").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}
	var url =  apiUrl+'/Apis/UserLoginAction';
	var otpUrl = apiUrl+'/Home/otpAuth';
	var data = {
		user_id: username,password:password,logintype:'web'
	};
	//alert(JSON.stringify(data)); return false;
	fetch(url, {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(data),
	})
	.then(function (res) {
			return res.text();
		})
	.then(function (data) {
			data = JSON.parse(data);
			//alert(JSON.stringify(data)); return false;
			if (data.success ==1) {
				document.loginBID.submit();
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
			}
			else if(data.success ==2){
				window.location.href = otpUrl+'/'+data.user_id;
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
				return false;
			}
			 else if(data.success ==0){
				setHtml("login_errors", "User does not exist");
				setTimeout(function () {
					setHtml("login_errors", "");
				}, 3000);
				submitBtn.querySelector(".loader").style.display = "none";
				submitBtn.removeAttribute("disabled");
				return false;
			}
		})
        	
}
//forgot password
const forgotPasswordHandler = (submitBtn) => {
const email_pattern =
		/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	const email = getValue("fp_email");
	var data = {
		email: email,
	};
	submitBtn.querySelector(".loader").style.display = "inline-block";
	submitBtn.setAttribute("disabled", true);
	if (email.trim() == "") {
		setHtml("fp_email_error", "Required");
		addClass(document.getElementById("fp_email"), "input_error");
		setTimeout(function () {
			setHtml("fp_email_error", "");
			removeClass(document.getElementById("fp_email"), "input_error");
		}, 5000);
		document.getElementById("fp_email").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	} else if (!email_pattern.test(email)) {
		setHtml("fp_email_error", "Invalid");
		addClass(document.getElementById("fp_email"), "input_error");
		setTimeout(function () {
			setHtml("fp_email_error", "");
			removeClass(document.getElementById("fp_email"), "input_error");
		}, 5000);
		document.getElementById("fp_email").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}

	fetch(forgotPassword, {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(data),
	})
		.then(function (res) {
			return res.text();
		})
		.then(function (data) {
			data = JSON.parse(data);
			submitBtn.querySelector(".loader").style.display = "none";
			submitBtn.removeAttribute("disabled");
			if (data.success == "1") {
				$("#successModalMessage").text(
					"Email Sent Successfully. Please check your inbox."
				);
				$("#successModal").modal("show");
				setTimeout(function () {
				$("#successModal").modal("hide");
				$("#forgotPasswordModal").modal("hide");
				}, 3000);
				$("#forgotPass_form").trigger("reset");
			} else {
				$('#fp_email').val('');
				alert("User does not exist.");
			}
		})
        
}
const forgotUserIdHandler = (submitBtn) => {
	const email_pattern =
		/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	const email = getValue("fu_user");
	var data = {
		email: email,
	};
	submitBtn.querySelector(".loader").style.display = "inline-block";
	submitBtn.setAttribute("disabled", true);
	if (email.trim() == "") {
		setHtml("fu_user_error", "Required");
		addClass(document.getElementById("fu_user"), "input_error");
		setTimeout(function () {
			setHtml("fu_user_error", "");
			removeClass(document.getElementById("fu_user"), "input_error");
		}, 5000);
		document.getElementById("fu_user").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	} else if (!email_pattern.test(email)) {
		setHtml("fp_email_error", "Invalid");
		addClass(document.getElementById("fu_user"), "input_error");
		setTimeout(function () {
			setHtml("fp_email_error", "");
			removeClass(document.getElementById("fu_user"), "input_error");
		}, 5000);
		document.getElementById("fu_user").focus();
		submitBtn.querySelector(".loader").style.display = "none";
		submitBtn.removeAttribute("disabled");
		return false;
	}

	fetch(forgotUserId, {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify(data),
	})
		.then(function (res) {
			return res.text();
		})
		.then(function (data) {
			data = JSON.parse(data);
			//alert(data.success);return false;
			submitBtn.querySelector(".loader").style.display = "none";
			submitBtn.removeAttribute("disabled");
			if (data.success == "1") {
				$("#successModalMessage").text(
					"Email Sent Successfully. Please check your inbox."
				);
				//$("#successModal").modal("show");
				setTimeout(function () {
				$("#successModal").modal("hide");
				$("#forgotUserIdModal").modal("hide");
				}, 3000);
				$("#forgotPass_form").trigger("reset");
			} else if(data.success == "0") {
				$('#fu_user').val('');
				alert("Record not exist!");
			}
		})
       
}

function userVerified(value)
{
	//alert(value); return false;
	var url =  apiUrl+'/Home/userVerified';
	var data = "user_id="+value;
	$.ajax({
      type: 'POST',
      url: url,
      data: data,
     success: function(resultData) {
      //alert(resultData); return false;
      if(resultData==1) { 
      setHtml("username_error", "Username already exist");
	  addClass(document.getElementById("username"), "input_error");
	  $('#username').val('');
	  setTimeout(function () {
	  setHtml("username_error", "");
	  removeClass(document.getElementById("username"), "input_error");
		}, 3000);
	 document.getElementById("username").focus();

	return false;
}
  }
});
	 
}


function emailVerified(value)
{
    //alert(value); return false;
    var url =  apiUrl+'/Home/emailVerified';
    var data = "email="+value;
    $.ajax({
      type: 'POST',
      url: url,
      data: data,
     success: function(resultData) {
     // alert(resultData); return false;
      if(resultData==1) { 
      setHtml("email_error", "Email already exist");
      addClass(document.getElementById("email"), "input_error");
      $('#email').val('');
      setTimeout(function () {
      setHtml("email_error", "");
      removeClass(document.getElementById("email"), "input_error");
        }, 3000);
     document.getElementById("email").focus();

    return false;
}
  }
});
     
}

//reset email
/*function femailVerified(value)
{
    //alert(value); return false;
    var url =  apiUrl+'/Home/emailVerified';
    var data = "email="+value;
    $.ajax({
      type: 'POST',
      url: url,
      data: data,
     success: function(resultData) {
     // alert(resultData); return false;
      if(resultData==0) { 
      setHtml("fp_email_error", "Record not exist");
      addClass(document.getElementById("fp_email"), "input_error");
      $('#fp_email').val('');
      setTimeout(function () {
      setHtml("fp_email_error", "");
      removeClass(document.getElementById("fp_email"), "input_error");
        }, 3000);
     document.getElementById("fp_email").focus();

    return false;
}
  }
});
     
}*/