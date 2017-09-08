<?php
    class javascript{
        public static function general(){
?>
<!-- General Script -->
<script type="text/javascript" src="public/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="public/js/bootstrap.js"></script>
<script type="text/javascript" src="public/js/npm.js"></script>
<?php
        }
        public static function accordion(){
?>
<!-- Accordion -->
<script type="text/javascript">
    function toggleChevron(e) {
        $(e.target)
            .prev('.panel-heading')
            .find("i.indicator")
            .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    }
    $('#accordion').on('hidden.bs.collapse', toggleChevron);
    $('#accordion').on('shown.bs.collapse', toggleChevron);
</script>
<?php
        }
        public static function modal(){
?>
<!-- Modal -->
<script type="text/javascript">
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.name input').val(recipient)
    })
</script>
<?php
        }
        public static function fvalidate(){
?>
<!-- Form Validator -->
<script type="text/javascript" src="public/js/form-validator/formValidation.js"></script>
<script type="text/javascript" src="public/js/form-validator/bootstrap.js"></script>
<?php
        }
        public static function fregistrasi(){
?>
<!-- Form Registrasi -->
<script type="text/javascript">
    $(document).ready(function() {
        // Generate a simple captcha
        function randomNumber(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        };
        $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));
        
        $('#registrasi').formValidation({
            message: 'Mohon periksa kembali data anda',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                pengguna: {
                    message: 'Nama pengguna tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Nama pengguna tidak boleh kosong'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'Nama pengguna minimal 6 dan maksimal 20 karakter'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'Nama pengguna hanya boleh terdiri dari alfabet, nomor, titik dan underscore'
                        }
                    }
                },
                nama: {
                    message: 'Nama lengkap tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Nama lengkap tidak boleh kosong'
                        },
                        stringLength: {
                            min: 1,
                            max: 35,
                            message: 'Nama lengkap maksimal 35 karakter'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z/ /]+$/,
                            message: 'Nama lengkap hanya boleh terdiri dari alfabet dan spasi'
                        }
                    }
                },
                gurukelas: {
                    message: 'Guru kelas tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Pilih guru kelas'
                        }
                    }
                },
                kelas: {
                    message: 'Kelas tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Pilih guru kelas'
                        }
                    }
                },
                nip: {
                    message: 'NIP tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'NIP tidak boleh kosong'
                        },
                        stringLength: {
                            min: 1,
                            max: 22,
                            message: 'Mohon isi NIP sesuai data'
                        },
                        regexp: {
                            regexp: /^[0-9/ /]+$/,
                            message: 'NIP hanya terdiri dari angka dan spasi'
                        }
                    }
                },
                absen: {
                    message: 'Nomor absen tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Nomor absen tidak boleh kosong'
                        },
                        stringLength: {
                            min: 1,
                            max: 2,
                            message: 'Nomor absen maksimal 3 karakter'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Nomor absen hanya terdiri dari angka'
                        }
                    }
                },
                mail: {
                    validators: {
                        notEmpty: {
                            message: 'Email tidak boleh kosong'
                        },
                        emailAddress: {
                            message: 'Email tidak valid'
                        }
                    }
                },
                profil: {
                    message: 'Foto profil tidak valid',
                    validators: {
                        file: {
                            extension: 'jpeg,jpg,gif,png,bmp',
                            type: 'image/jpeg,image/gif,image/png,image/x-ms-bmp',
                            maxSize: 2097152,
                            message: 'File harus bertipe JPEG/JPG/GIF/PNG/BMP dan kurang dari 2 MB'
                        }
                    }
                },
                profilsiswa: {
                    message: 'Foto profil tidak valid',
                    validators: {
                        file: {
                            extension: 'jpeg,jpg,gif,png,bmp',
                            type: 'image/jpeg,image/gif,image/png,image/x-ms-bmp',
                            maxSize: 2097152,
                            message: 'File harus bertipe JPEG/JPG/GIF/PNG/BMP dan kurang dari 2 MB'
                        }
                    }
                },
                kunci: {
                    validators: {
                        notEmpty: {
                            message: 'Kata kunci tidak boleh kosong'
                        }
                    }
                },
                ulangikunci: {
                    validators: {
                        notEmpty: {
                            message: 'Konfirmasi kata kunci tidak boleh kosong'
                        },
                        identical: {
                            field: 'kunci',
                            message: 'Kata kunci tidak sama'
                        }
                    }
                },
                captcha: {
                    validators: {
                        callback: {
                            message: 'Periksa kembali jawaban anda',
                            callback: function(value, validator) {
                                var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                                return value == sum;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
<?php
        }
        public static function flogin(){
?>
<!-- Form Login -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#login').formValidation({
            message: 'Mohon periksa kembali data anda',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                namalogin: {
                    message: 'Nama pengguna tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Nama pengguna tidak boleh kosong'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'Nama pengguna minimal 6 dan maksimal 20 karakter'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'Nama pengguna hanya boleh terdiri dari alfabet, nomor, titik dan underscore'
                        }
                    }
                },
                kuncilogin: {
                    message: 'Kata kunci tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Kata kunci tidak boleh kosong'
                        }
                    }
                }
            }
        });
    });
</script>
<?php
        }
        public static function forgetpass(){
?>
<!-- Form Lupa Kata kunci -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#sendmail').formValidation({
            message: 'Mohon periksa kembali data anda',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                forgetmail: {
                    validators: {
                        notEmpty: {
                            message: 'Email tidak boleh kosong'
                        },
                        emailAddress: {
                            message: 'Email tidak valid'
                        }
                    }
                },
                forgetusername: {
                    message: 'Nama pengguna tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Nama pengguna tidak boleh kosong'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'Nama pengguna minimal 6 dan maksimal 20 karakter'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'Nama pengguna hanya boleh terdiri dari alfabet, nomor, titik dan underscore'
                        }
                    }
                }
            }
        });
    });
</script>
<?php
        }
        public static function formfgpass(){
?>
<!-- Form Lupa Kata kunci -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#forgetpass').formValidation({
            message: 'Mohon periksa kembali data anda',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                userfp: {
                    message: 'Nama pengguna tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Nama pengguna tidak boleh kosong'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'Nama pengguna minimal 6 dan maksimal 20 karakter'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'Nama pengguna hanya boleh terdiri dari alfabet, nomor, titik dan underscore'
                        }
                    }
                },
                tokenfp: {
                    message: 'Kode tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Nama pengguna tidak boleh kosong'
                        }
                    }
                },
                passfp: {
                    validators: {
                        notEmpty: {
                            message: 'Kata kunci tidak boleh kosong'
                        }
                    }
                },
                repassfp: {
                    validators: {
                        notEmpty: {
                            message: 'Konfirmasi kata kunci tidak boleh kosong'
                        },
                        identical: {
                            field: 'kunci',
                            message: 'Kata kunci tidak sama'
                        }
                    }
                }
            }
        });
    });
</script>
<?php
        }
    }
?>