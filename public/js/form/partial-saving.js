$(document).ready(function() {
    $('.select-class').selectize();

    $('#partial-saving').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'fa fa-refresh'
        },
        fields: {
            savedMoney: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            withdrawMoney: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            applicantName: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            codeName: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            address: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            applicantMobile: {
                validators: {
                    stringLength: {
                        min: 7,
                        max: 11,
                        message: '৭ থেকে ১১ সংখ্যার মধ্যে হতে হবে'
                    },
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },

        }
    });
});