$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Larvel Validation with Ajax Request    
    $(".validateForm").validate({
        errorPlacement: function(error, element) {
            return;
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
            $(element).parent().addClass("error");
        },
        unhighlight: function(element) {
            $(element).parent().removeClass("error");
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            var formData = new FormData($(".validateForm")[0]);
            $('.text-danger').html('');
            $.ajax({
                beforeSend: function() {
                    $('.formPreloader').show();
                },
                url: $(".validateForm").attr('action'),
                data: formData,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(response) {
                  $('.formPreloader').hide();
                    if (response.success) {
                        toastr.success(response.message);
                        swal("", response.message, "success");
                        setTimeout(function() {
                            if (response.url == 'front') {
                                location.reload();
                                
                            }else if( response.url != ''){
                                window.location.replace(response.url);
                            } else {
                                $('.zoomIn').modal('hide');
                                setTimeout(function() {
                                    $('.yajra-datatable').DataTable().ajax.reload();
                                }, 1000);
                            }
                        }, 1000);
                    }

                    if (response.status == "error") {
                        toastr.error(response.message);
                        swal("", response.message, "error");
                    }
                },

                error: function (response) {
                    $('.formPreloader').hide();
                    let errors = response.responseJSON.errors;
                    $.each(errors, function(i, v) {
                        toastr.error(v[0], 'Opps!');
                    });
                    $.each(errors, function(key, value) {
                        console.log('.Err' + key, value[0]);
                        $('.Err' + key).text(value[0]);
                    });
                }
            });
            return false;
        }
    });

    // Second laravel validation ajax
    $(".validateForm2").validate({
        errorPlacement: function(error, element) {
            return;
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
            $(element).parent().addClass("error");
        },
        unhighlight: function(element) {
            $(element).parent().removeClass("error");
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            var formData = new FormData($(".validateForm2")[0]);
            $('.text-danger').html('');
            $.ajax({
                beforeSend: function() {
                    $('.formPreloader2').show();
                },
                url: $(".validateForm2").attr('action'),
                data: formData,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(response) {
                  $('.formPreloader2').hide();
                    if (response.success) {
                        toastr.success(response.message);
                        swal("", response.message, "success");
                        setTimeout(function() {
                            if (response.url != '') {
                                window.location.replace(response.url);
                            } else {
                                $('.zoomIn').modal('hide');
                                setTimeout(function() {
                                    $('.yajra-datatable').DataTable().ajax.reload();
                                }, 1000);
                            }
                        }, 1000);
                    }

                    if (response.status == "error") {
                        toastr.error(response.message);
                        swal("", response.message, "error");
                    }
                },

                error: function (response) {
                    $('.formPreloader2').hide();
                    let errors = response.responseJSON.errors;
                    $.each(errors, function(i, v) {
                        toastr.error(v[0], 'Opps!');
                    });
                    $.each(errors, function(key, value) {
                        $('.Err' + key).text(value[0]);
                    });
                }
            });
            return false;
        }
    });

    // delete yajra table records
    $(document).on('click','.deleteDataTableRow',function(){
        let selector = $(this);
        var tr       = selector.closest('tr');
        var data     = tr.attr('row-id');
        swal({
         title: 'Are you Sure ?',
         text: 'You want to delete',
         icon: "warning",
         buttons: true,
         dangerMode: true,
       })
       .then((willDelete) => {
         if (willDelete) {
            $.ajax({
                type: "POST",
                url: ajax+'/admin/delete-datatable-row',
                data: {data:data},
                timeout: 800000,
                success: function (response) {
                    tr.fadeOut(1000, function(){
                        selector.remove();
                    }); 

                    if (response.status == "error") {
                        toastr.error(response.error);
                        swal("", response.error, "error");
                    }
                    if (response.status == "success") {
                        swal(response.message, {icon: "success",});
                        toastr.success(response.message);
                        setTimeout(function() {
                            $('.yajra-datatable').DataTable().ajax.reload();
                        }, 1000);
                    }
                }
            });
         } 
       });
    })


    $(document).on('click','.status_change_datatable',function(){
       let selector = $(this);
       let tr       = selector.closest('tr');
       let data     = tr.attr('row-id');
       swal({
         title: 'Are you sure ?',
         text: 'You want to change status',
         icon: "warning",
         buttons: true,
         dangerMode: true,
       })
       .then((willChange) => {
         if (willChange) {
            $.ajax({
                type: "POST",
                url: ajax+'/admin/status-change',
                data: {data:data,status:selector.text()},
                // timeout: 800000,
                success: function (response) { 
                    if (response.status == "error") {
                        toastr.error(response.error);
                        swal("", response.error, "error");
                    }
                    if (response.success) {
                        toastr.success(response.message);
                        swal("", response.message, "success");
                        setTimeout(function() {
                            $('.yajra-datatable').DataTable().ajax.reload();
                        }, 1000);
                    }
                }
            });
         } 
       });   
    });


    $('.image').change(function(){
        $('.preview_image_div').show();
        $('.image_show').hide();
        $(".preview_image").css("display", "block");
        let reader = new FileReader();
        reader.onload = (e) => {
            $('.preview_image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
    
})