<?php
    class jscode{
        public static function general(){
?>
        <!-- General -->
        <script type="text/javascript" src="http://localhost:8080/elprowinmvc.com/public/js/jquery-1.11.2.js"></script>
        <script type="text/javascript" src="http://localhost:8080/elprowinmvc.com/public/js/bootstrap.js"></script>
<?php
        }
        public static function generalval(){
?>
        <!-- Form Validator -->
        <script type="text/javascript" src="http://localhost:8080/elprowinmvc.com/public/js/form-validator/formValidation.js"></script>
        <script type="text/javascript" src="http://localhost:8080/elprowinmvc.com/public/js/form-validator/bootstrap.js"></script>
<?php
        }
        public static function edprofilval(){
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
                                    message: 'Field kelas tidak boleh kosong'
                                }
                            }
                        },
                        absen: {
                            message: 'NIP tidak valid',
                            validators: {
                                notEmpty: {
                                    message: 'No Absen tidak boleh kosong'
                                },
                                stringLength: {
                                    min: 1,
                                    max: 3,
                                    message: 'No Absen maksimal 3 karakter'
                                },
                                regexp: {
                                    regexp: /^[0-9]+$/,
                                    message: 'No absen hanya terdiri dari angka'
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
        public static function comment(){
?>
<!--Captcha-->
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
        public static function tinymce(){
?>
<!-- TinyMCE editor -->
<script src="http://localhost:8080/elprowinmvc.com/public/js/cdn/tinymce/tinymce.min.js"></script>
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
       
       external_filemanager_path:"http://localhost:8080/elprowinmvc.com/public/js/cdn/filemanager/",
       filemanager_title:"Responsive Filemanager" ,
       external_plugins: { "filemanager" : "../filemanager/plugin.min.js"}
    });
</script>
<?php
        }
        public static function jspdf(){
?>
<script type="text/javascript" src="http://localhost:8080/elprowinmvc.com/public/js/jspdf/dist/jspdf.min.js"></script>
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
    }
?>