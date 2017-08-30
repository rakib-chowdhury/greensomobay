$(document).ready(function() {
    $('.select-class').selectize();

    $('#loanApplicantForm').bootstrapValidator({
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
            applicantName: {
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
            applicantGuardian: {
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
            division: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            district: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            thana: {
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
            permanentDivision: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            permanentDistrict: {
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
            applicantDate: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            registrationNumber: {
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
            applicantProfession: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            guardianCareers: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            partialRefund: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            proposedLoan: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            creditSector: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            termLoan: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            applicantSignature: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            signatureDate: {
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
                        max: 17,
                        message: '১৭ সংখ্যার হতে হবে'
                    },
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
            guardianSignature: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            witnessSignature1: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            witnessSignature2: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
            witnessSignature3: {
                validators: {
                    notEmpty: {
                        message: 'আবশ্যক'
                    }
                }
            },
        }
    });


});