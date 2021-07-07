$(document).ready(function() {

$.validator.addMethod("emailCustom", function (value, element, params) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(value);
}, "Please enter a valid email address.");
});

function placeOrderFormProcess()
{
    $("#placeOrderForm").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            phone_number: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 12
            },
            pincode: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 6
            },
            address: {
                required: true
            },
            state_id: {
                required: true
            },
            city_id: {
                required: true
            }
        },
        messages: {

        },
        submitHandler: function (form) {
            form.submit();
        }
    });
}

function loginFormProcess()
{
    $("#login-form").validate({  
        rules: {
            email_id: {
                required: true,
                emailCustom:true
            },
            password: {
                required: true
            }

        },
        messages: {
        },
        submitHandler: function (form) {  
            form.submit();
            //$("#signup").submit();
        }
    });
}

function forgotFormProcess()
{
    $("#forgot-form").validate({  
        rules: {
            email_id: {
                required: true,
                emailCustom: true
            }

        },
        messages: {
        },
        submitHandler: function (form) {  
            form.submit();
            //$("#signup").submit();
        }
    });
}

function newsletterProcess()
{
    $("#newsletterForm").validate({  
        rules: {
            inputEmail: {
                required: true,
                emailCustom: true
            }
        },
        messages: {
        },
        submitHandler: function (form) {  
            //form.submit();
            var email_news = $('#inputEmail').val();
            var ip_address = $('#ip_address').val();
            var dataString = 'email_news=' + email_news +'&ip_address=' + ip_address;
            $.ajax({ 
                type: 'POST',
                url: baseUrl + '/ajax/newsletterEmailCheck',
                data: dataString,
                success: function(data) {
                    bootbox.alert(data);
                }
            });
        }
    });
}

function registerFormProcess() 
{
    $("#register-form").validate({
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            phone_number: {
                required: true
            },
            email_id: {
                required: true,
                emailCustom: true
            },
            ppassword: {
                required: true
            },
            cpassword: {
                required: true,
                equalTo: "#ppassword"
            }

        },
        messages: {
        },
        submitHandler: function (form) {  
            form.submit();
            //$("#logon-submit").submit();
        }
    });
}

function profileFormProcess() 
{
    $("#profileForm").validate({
        rules: {
            name: {
                required: true
            },
            phone_number: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 12
            },
            email_id: {
                required: true,
                emailCustom: true
            }

        },
        messages: {
        },
        submitHandler: function (form) {  
            form.submit();
            //$("#logon-submit").submit();
        }
    });
}

function checkoutFrmProcess() 
{
    $("#checkoutFrm").validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email_id: {
                required: true,
                email:true
            },
            phone_number: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 12
            },
            pincode: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 6
            },
            address: {
                required: true
            },
            house_no: {
                required: true
            },
            state: {
                required: true
            },
            city: {
                required: true
            }

        },
        messages: {
        },
        submitHandler: function (form) {  
            form.submit();
            //$("#logon-submit").submit();
        }
    });
}
 
///////////////////////////
function contactFrmProcess()
{   
    $("#contactFrm").validate({  
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            
            email: {
                required: true,
                emailCustom: true

            },
            contact_number: {
                required: true,
                minlength: 9,
                maxlength: 10,
                number: true

            },
            message: {
                required: true

            }

        },
        messages: {
        },
        submitHandler: function (form) {  
            form.submit();
            //$("#signup").submit();
        }
    });
}
/*For astrologer book form*/
function bookFrmProcess()
{  
    $("#bookFrm").validate({  
        rules: {
            name: {
                required: true
            },  
            email: {
                required: true,
                emailCustom: true

            },
            phone_number: {
                required: true,
                minlength: 9,
                maxlength: 10,
                number: true

            },
              astrologer_date_time: {
                required: true
            },
            language_id: {
                required: true

            }

        },
        messages: {
        },
        submitHandler: function (form) {  
            form.submit();
            //$("#signup").submit();
        }
    });
}


/*For header Search form*/
function SearchFrmProcess()
{  
    $("#searchFrm").validate({  
        rules: {
            keyword: {
                required: true
            },   
        },
        messages: {
        },
        submitHandler: function (form) {  
            form.submit();
            //$("#signup").submit();
        }
    });
}



//----------  Update profile validation ---

// For rider login proces
function profileUpdateValidation()
{
    $("#profileForm").validate({
        rules: {
            name: {
                required: true

            },
            email: {
                required: true,
                emailCustom: true,
            },
            // email: {
            //     required: true,
            //     email: true,
            //     remote: {
            //         url: baseUrl + '/login/emailCheckSupplier',
            //         type: "post",
            //         datatype: 'json',
            //         data: {
            //             email_id: function () {
            //                 return $("#email").val();
            //             }
            //         }
            //     }
            // },
            phone_number: {
                required: true,
                number: true

            },
            gst_number: {
                required: true,
                number: true

            },
            company_name: {
                required: true

            },
            payment_description: {
                required: true,
            },
            address: {
                required: true,
            },
            warranty: {
                required: true,
            },
        },
        messages: {
            name: {
                required: 'Name is required'
            },
            email: {
                required: 'Email address is required',
            },
            phone_number: {
                required: 'Phone is required'
            },
            gst_number: {
                required: 'GST  is required'
            },
            company_name: {
                required: 'Company Name  is required'
            },
            payment_description: {
                required: 'Payment Description is required'
            },
            address: {
                required: 'Address  is required'
            },
            warranty: {
                required: 'Warranty Description is required'
            }
        },
        submitHandler: function (form) {
            form.submit();
            //$("#login").submit();
        }
    });
}







///////////////////////////
function donateFormProcess()
{
    $("#donateForm").validate({
        rules: {
            donate_amount: {
                required: true
            },
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true,
                emailCustom: true

            },
            mobile_phone: {
                required: true,
                minlength: 9,
                maxlength: 10,
                number: true

            },
            address: {
                required: true

            },
            message: {
                required: true

            }

        },
        messages: {
        },
        submitHandler: function (form) {
            form.submit();
            //$("#signup").submit();
        }
    });
}

function applicationFormProcess() {
    $("#applicationForm").validate({
        rules: {
            salesman_id: {
                required: true
            },
            start_date: {
                required: true
            },
            dealer_id: {
                required: true
            },
            address: {
                required: true
            },
            state_id: {
                required: true
            },
            city_id: {
                required: true
            },
            'signage[]': {
                required: true
            },
            supplier_id: {
                required: true
            },
            support_app: {
                required: true
            },
            
            target_sales: {
                required: true
            },
            type: {
                required: true
            },
            application_type_id: {
                required: true    
            },
        },
        messages: {
            'signage[]': "Please select at least one signage ."
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
}
function applicationeditFormProcess() {
    $("#applicationForm").validate({
        rules: {
            salesman_id: {
                required: true
            },
            start_date: {
                required: true
            },
            dealer_id: {
                required: true
            },
            address: {
                required: true
            },
            state_id: {
                required: true
            },
            city_id: {
                required: true
            },
            'signage[]': {
                required: true
            },
            supplier_id: {
                required: true
            },
            support_app: {
                required: true
            },
            target_sales: {
                required: true
            },
        },
        messages: {
            'signage[]': "Please select at least one signage ."
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
}
function createQuotationFormProcess() {
    $("#quotationForm").validate({
        rules: {
            
            'item[]': {
                required: true
            },
            'dimension[]': {
                required: true
            },
            'quantity[]': {
                required: true
            },
           
        },
       
        submitHandler: function (form) {
            form.submit();
        }
    });
}
function prooffFormProcess() {
    $("#complelteFrm").validate({
        rules: {
            remark: {
                required: true
            },
           
        },
       
        submitHandler: function (form) {
            form.submit();
        }
    });
}
function visualFormProcess() {
    $("#uploadVisualFrm").validate({
        rules: {
            'pdf[]': {
                required: true
            },
            'file[]': {
                required: true
            },
        },
       
        submitHandler: function (form) {
            form.submit();
        }
    });
}





function errorBoot(message)
{  
    bootbox.alert(message, function () {
        //console.log("Alert Callback");
        var url = document.URL;
        var start = url.indexOf('?');
        var new_url = url.substr(0, start);
        //window.location.href=new_url;
        history.pushState('data', '', new_url);
    });
}

function errorBootId(message)
{
    bootbox.alert(message, function () {
        //console.log("Alert Callback");
        var url = document.URL;
        var start = url.indexOf('&');
        var new_url = url.substr(0, start);
        window.location.href = new_url;
    });
}

//function for Simple bootbox
function sucessBoot(message) {
    bootbox.alert(message, function () {
//console.log("Alert Callback");

    });
}

//For login form Process
function loginForm() {

    jQuery("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
            role_id: {
                required: true,
            }
        },
        submitHandler: function (form) {
            form.submit();
            //$("#loginForm").submit();
        }
    });
}

//For ForGet password Process
function forgetpasswordForm() {

    jQuery("#forgetForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            role_id: {
                required: true,
            }
        },
        submitHandler: function (form) {
            form.submit();
            //$("#forgetForm").submit();
        }
    });
}

//For Change password Process
function changepasswordForm() {
 
    jQuery("#resetPass_form").validate({
        rules: {
          
            new_pass: {
                required: true,
            },
            con_password: {
                required: true,
                equalTo: "#new_pass"
            }
        },
        submitHandler: function (form) {
            form.submit();
            //$("#forgetForm").submit();
        }
    });
}

//For create quotaion Process
function createQuotationForm() {

    jQuery("#quotationForm").validate({
        rules: {
            itemname: {
                required: true,
            },
            dimension: {
                required: true,
            },
            quantity: {
                required: true,
            },
            price: {
                required: true,
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
}

// For Reason Modal Process
function reasonModelForm() {
    jQuery("#reasonForm").validate({
        rules: {
            reason: {
                required: true,
            },
            chkbox: {
                required: true,
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
}


// For show ajax loader
 
  function ajaxindicatorstop()
	{
	    jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeOut(300);
	    jQuery('body').css('cursor', 'default');
	}
        
    function ajaxindicatorstart(text)
	{
		if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
		jQuery('body').append('<div id="resultLoading" style="display:none"><div><img height="80px" width="80px" src="'+baseUrl+'/package/images/spinner.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
		}
		
		jQuery('#resultLoading').css({
			'width':'100%',
			'height':'100%',
			'position':'fixed',
			'z-index':'10000000',
			'top':'0',
			'left':'0',
			'right':'0',
			'bottom':'0',
			'margin':'auto'
		});	
		
		jQuery('#resultLoading .bg').css({
			'background':'#000000',
			'opacity':'0.7',
			'width':'100%',
			'height':'100%',
			'position':'absolute',
			'top':'0'
		});
		
		jQuery('#resultLoading>div:first').css({
			'width': '250px',
			'height':'75px',
			'text-align': 'center',
			'position': 'absolute',
			'top':'-50%',
			'left':'0',
			'right':'0',
			'bottom':'0',
			'margin':'auto',
			'font-size':'16px',
			'z-index':'10',
			'color':'#ffffff'
			
		});

	    jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeIn(300);
	    jQuery('body').css('cursor', 'wait');
	}

