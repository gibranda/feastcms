$(document).ready(function() {
    var $validator = $("#wizardForm").validate({
        rules: {
            title: {
                required: true
            },
            root: {
                required: true
		    },
		    email: {
                required: true,
                email: true
		    },
		    language: {
                required: true
		    },
		    host_name: {
                required: true
		    },
		    db_username: {
                required: true
		    },
		    db_password: {
                required: false
		    },
		    db_name: {
                required: true
            },
		    username: {
                required: true
		    },
		    user_email: {
                required: true,
                email: true
		    },
		    password: {
                required: true
            },
		    password2: {
                required: true,
                equalTo: '#password'
            }
        }
    });

    $('#rootwizard').bootstrapWizard({
        'nextSelector': '.next', 
        'previousSelector': '.previous',
        'tabClass': 'nav nav-tabs',
        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length-1;
            var $current = index;
            var $percent = ($current/$total) * 100;
            if(index !== 0) {
                $('#rootwizard').find('.progress-bar').css({width:$percent+'%'});
            }
            else {
                $('#rootwizard').find('.progress-bar').css({width:0+'%'});
            }
        },
        'onNext': function(tab, navigation, index) {
            var $valid = $("#wizardForm").valid();
            if(!$valid) {
                $validator.focusInvalid();
                return false;
            }
            if(index == 4) {
                $('form#wizardForm')[0].submit();
            }
        },
        'onTabClick': function(tab, navigation, index) {
            var $valid = $("#wizardForm").valid();
            if(!$valid) {
                $validator.focusInvalid();
                return false;
            }
        },
    });

    $('.form-group').each(function() {
        if( $('.error', this).length ){
            $(this).addClass('has-error');
        }
    });
});