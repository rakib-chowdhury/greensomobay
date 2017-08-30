$(document).ready(function() {
    $('.select-class').selectize();    

    $('#memberAdmitFrom').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'fa fa-refresh'
        },
        fields: {
            applierName: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            applierOccupation: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            guardianName: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            guardianOccupation: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            motherName: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            motherOccupation: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            location: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            postalLocation: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            permanentLocation: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            permanentPostal: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            nationalism: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            religion: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            idNumber: {
                validators: {
                    stringLength: {
                        min: 17,
                        max:17,
                        message: '১৭ সংখ্যার হতে হবে'
                    },
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            bloodGroup: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            educationQuality: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            maritalStatus: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            nomineeName: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            nomineeRelation: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            phoneNumber: {
                validators: {
                    stringLength: {
                        min: 7,
                        max:11,
                        message: '৭ থেকে ১১ সংখ্যার মধ্যে হতে হবে'
                    },
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            officeLocation: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            picture: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            nomineePicture: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            applicantSign: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            }
        }
    });

    
});