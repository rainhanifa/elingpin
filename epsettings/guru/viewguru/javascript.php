<!-- General -->
<?php
    class javascript{
        public static function general(){
?>
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/elprowinmvc.com/public/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/elprowinmvc.com/public/js/bootstrap.js"></script>
<?php
        }
        public static function formvalidate(){
?>
<!-- Form Validator -->
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/elprowinmvc.com/public/js/form-validator/formValidation.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/elprowinmvc.com/public/js/form-validator/bootstrap.js"></script>
<?php
        }
        public static function formprofil(){
?>
<!-- Form Update Profil -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#formedprofil').formValidation({
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
                    validators: {
                        file: {
                            extension: 'jpeg,jpg,gif,png,bmp',
                            type: 'image/jpeg,image/gif,image/png,image/x-ms-bmp',
                            maxSize: 2097152,
                            message: 'File harus bertipe JPEG/JPG/GIF/PNG/BMP dan kurang dari 2 MB'
                        }
                    }
                },
                ulangikunci: {
                    validators: {
                        identical: {
                            field: 'kunci',
                            message: 'Password tidak sama'
                        }
                    }
                }
            }
        });
    });
</script>
<?php
        }
        public static function formmateri(){
?>
<!-- Form Materi -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#fdatamateri').formValidation({
            message: 'Mohon periksa kembali data anda',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                materi: {
                    message: 'Field materi tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Field materi tidak boleh kosong'
                        }
                    }
                },
                submateri: {
                    message: 'Field submateri tidak valid',
                    validators: {
                        notEmpty: {
                            message: 'Field submateri tidak boleh kosong'
                        }
                    }
                }
            }
        });
    });
</script>
<?php
        }
        public static function otomateri(){
?>
<!-- Pemilihan otomatis untuk materi dan submateri -->
<script type="text/javascript" src="public/js/ajaxmateri.js"></script>
<?php
        }
        public static function formkonten(){
?>
<!-- Form Konten Materi -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#formtmkonten').formValidation({
            message: 'Mohon periksa kembali data anda',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                materi: {
                    validators: {
                        notEmpty: {
                            message: 'Field Materi tidak boleh kosong'
                        }
                    }
                },
                submateri: {
                    validators: {
                        notEmpty: {
                            message: 'Field Submateri tidak boleh kosong'
                        }
                    }
                },
                kategori: {
                    validators: {
                        notEmpty: {
                            message: 'Field Kategori tidak boleh kosong'
                        }
                    }
                },
                isimateri: {
                    validators: {
                        notEmpty: {
                            message: 'Field Isimateri tidak boleh kosong'
                        }
                    }
                }
            }
        });
    });
</script>
<?php
        }
        public static function tab(){
?>
<!-- Tab Class Activity -->
<script type="text/javascript">
    $('#myTab a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })
</script>
<?php
        }
        public static function formnilai(){
?>
<!-- Form Pengisian Nilai -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#fnilaisis').formValidation({
            message: 'Mohon periksa kembali data anda',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                detnilai: {
                    validators: {
                        notEmpty: {
                            message: 'Field Detail Nilai tidak boleh kosong'
                        }
                    }
                },
                nilaiclass: {
                    validators: {
                        notEmpty: {
                            message: 'Field Nilai tidak boleh kosong'
                        },
                        stringLength: {
                            min: 1,
                            max: 3,
                            message: 'Rentang data nilai adalah 0 - 100'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Data nilai hanya terdiri dari angka'
                        }
                    }
                },
                nilailab: {
                    validators: {
                        notEmpty: {
                            message: 'Field Nilai tidak boleh kosong'
                        },
                        stringLength: {
                            min: 1,
                            max: 3,
                            message: 'Rentang data nilai adalah 0 - 100'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Data nilai hanya terdiri dari angka'
                        }
                    }
                }
            }
        });
    });
</script>
<?php
        }
        public static function tinymce(){
?>
<!-- TinyMCE editor -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/elprowinmvc.com/public/js/cdn/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: "textarea", theme: "modern",
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
       ],
       toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
       toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
       image_advtab: true ,
       
       external_filemanager_path:"http://<?php echo $_SERVER['HTTP_HOST']; ?>/elprowinmvc.com/public/js/cdn/filemanager/",
       filemanager_title:"Responsive Filemanager" ,
       external_plugins: { "filemanager" : "../filemanager/plugin.min.js"}
    });
</script>
<?php
        }
        public static function comment(){
?>
<script type="text/javascript">
    $(document).ready(function() {
        // Generate a simple captcha
        function randomNumber(min, max) {
            return Math.floor(Math.random() * (max - min + 1) + min);
        };
        $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));
        $('#formkomentar').bootstrapValidator({
            message: 'Mohon periksa data masukan anda',
            fields: {
                komentar: {
                    validators: {
                        notEmpty: {
                            message: 'Field komentar tidak boleh kosong'
                        }
                    }
                },
                subjek: {
                    validators: {
                        notEmpty: {
                            message: 'Field subjek tidak boleh kosong'
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
        public static function jspdf(){
?>
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/elprowinmvc.com/public/js/jspdf/dist/jspdf.min.js"></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/elprowinmvc.com/public/js/jspdf/jspdf.plugin.addimage.js"></script>
<script type="text/javascript">
    var doc     = new jsPDF();
    var type    = document.getElementById("materitype").value;
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    $('#print').click(function () {
        doc.fromHTML($('#printpdf').html(), 15, 15, {
            'width': 170,
                'elementHandlers': specialElementHandlers
        });
        doc.save(type+'.pdf');
    });
</script>
<?php
        }
        public static function printarea(){
?>
<!--Print Area-->
<script src="public/js/printarea/jquery-ui-1.10.4.custom.js" type="text/JavaScript" language="javascript"></script>
<script src="public/js/printarea/jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>
<script>
    $("#print").click(function(){
        $("#printpdf").printArea();
    });
</script>
<?php
        }
        public static function download(){
?>
<script type="text/javascript">
    function getname(id){
        
        var setid = "#" + id;
        
        nameVal     = $(setid).text();
        user        = $('#name').text();
        submateri   = $('#materitype').attr('value');
        
        $.ajax({
			type: 'post',
			url: 'viewguru/ajax.php',
			data: {
				get_dataname:nameVal,
                get_user:user,
                get_materi:submateri
			}
		});       
    }
</script>
<?php
        }
        public static function iframerespon(){
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("iframe").wrap("<div class='embed-responsive embed-responsive-16by9'></div>");
        $("iframe").addClass("embed-responsive-item");
    });
</script>
<?php
        }
        public static function imagerespon(){
?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".materi-siswa").find("img").addClass("img-responsive");
    });
</script>
<?php
        }
        public static function tablerespon(){
?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".materi-siswa").find("table").wrap("<div class='table-responsive'></div>");
    });
</script>
<?php
        }
    }
?>