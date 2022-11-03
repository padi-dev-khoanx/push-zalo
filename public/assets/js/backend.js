'use strict';

$('.submit-button').on('click', function() {
    $('.form-submit').submit();
})

function checkboxAll(single_element, all_element) {
    let checkbox_all = true;
    $(single_element).each(function(index, element) {
        if ($(element).is(':checked') === false) {
            checkbox_all = false;
        }
    });
    if (checkbox_all === false) {
        all_element.prop('checked', false);
    } else {
        all_element.prop('checked', true);
    }
}

$('#detailModal').on('hidden.bs.modal', function () {
    $('input').attr('disabled', false)
    $('select').attr('disabled', false)
    $('textarea').attr('disabled', false)
    dialog.close()
})

function readURL(input) {
    if (input.files && input.files[0]) {

        var reader = new FileReader();

        $('.file-upload-image').attr('src', '');
        reader.onload = function(e) {
            $('.image-upload-wrap').hide();
            $('.not-image-file').hide()
            $('.image-title').html('upload');
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
            if (validImageTypes.includes(input.files[0].type)) {
                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-image').show();
                $('.image-title').html(input.files[0].name);
            } else {
                $('.not-image-file').show()
                $('.not-image-file').html(input.files[0].name)
                $('.file-upload-image').hide();
            }
            $('.file-upload-content').show();

        };

        reader.readAsDataURL(input.files[0]);

    } else {
        removeUpload();
    }
}

var checkNotInputAmount = (className) => {
    let check = true;
    $(className).each(function(){
        if($(this).val() <= 0){
            $(this).addClass('is-invalid')
            $(this).next('.invalid-feedback').remove()
            $(this).after(`<span class="error invalid-feedback" style="display:block">Chưa nhập giá trị</span>`) ;
            check = false
        }
    })
    return check;
}

function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
    $('#input-url-file').val('')
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
});
$('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});

function delete_record(id, url, element = null) {
    $.ajax({
        method: 'POST',
        url: url,
        type: 'json',
        data: { 'id': id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {

            if (response.status == 'success') {
                toastr.success(response.message);
                setTimeout(function(){
                    if (element === null) {
                        location.reload();
                    } else {
                        $(element).closest('tr').remove();
                    }
                }, 1000);


            } else if (response.status == 'error') {
                toastr.error(response.message)
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            toastr.error(xhr.responseJSON.message)
        }
    });

}

function update_status_order(id, url) {
    $.ajax({
        method: 'POST',
        url: url,
        type: 'json',
        data: { 'id': id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {

            if (response.status == 'success') {
                toastr.success(response.message);
                location.reload();

            } else if (response.status == 'error') {
                toastr.error(response.message)
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            toastr.error(xhr.responseJSON.message)
        }
    });

}

var dialog = (function(){
    return {
        confirm: (content, __callback) => {
            const html = `
                <p>${content}</p>
                <button type="button" class ="btn btn-primary" id="digimango_messageBoxOkButton">Xác nhận</button>
                <button type="button" class ="btn btn-default" data-dismiss="modal" onclick="dialog.close()">Huỷ</button>
            `
            $('#detailModal .modal-dialog').removeClass('modal-lg')
            $('#finishModalLabel').html('Xác nhận');
            $('#modal_content').html(html);
            $('#detailModal').modal('show');
            $('#digimango_messageBoxOkButton').on('click', function(){
                __callback(true)
                dialog.close()
            })
        },
        alert: (content) => {
            const html = `
                <p>${content}</p>
                <button type="button" class ="btn btn-primary" id="digimango_messageBoxOkButton">Xác nhận</button>
            `
            $('.modal-dialog').removeClass('modal-lg')
            $('#finishModalLabel').html('Xác nhận');
            $('#modal_content').html(html);
            $('#detailModal').modal('show');
            $('#digimango_messageBoxOkButton').on('click', function(){
                dialog.close()
            })
        },
        show : function(title, data){
            $('#detailModal .modal-dialog').addClass('modal-lg')
            $('#finishModalLabel').html(title);
            $('#modal_content').html(data);
            $('#btnAction').attr('onclick', 'return formHelper.onSubmit("frmDialogCreate")');
            $('#detailModal').modal('show');
        },
        close: function () {
            $('#detailModal').modal('hide');
            $('#detailModal').css('display', 'none').attr('aria-hidden', 'true');
            $('#finishModalLabel').html('');
            $('#modal_content').html('');
        },
    }
})();

var btn_loading = (function () {
    return {
        loading : function (btn_id) {
            var $btn = $('#' + btn_id);
            $btn.prop('disabled', true);
            $btn.append('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>')
        },
        hide : function (btn_id) {
            var $btn = $('#' + btn_id);
            $btn.prop('disabled', false);
            $btn.children('span').remove();
        }
    };
})();

var formHelper = (function () {
    return {
        postFormJson: function (objID, onSucess) {
            var url = document.getElementById(objID).action;
            $.post(url, $('#' + objID).serialize(), function (data) {
                onSucess(data);
            }, 'json')
            .fail(function(data) {
                onSucess(data.responseJSON)
            });
        }
    };
})();

var helper = (function () {
    return {
        create: function (url, title = '') {
            btn_loading.loading("create");
            $.get(url, null, function (result) {
                btn_loading.hide("create");
                dialog.show("Tạo mới " + title, result);
            });
        },
        edit: function (url, title) {
            btn_loading.loading("edit");
            $.get(url, null, function (result) {
                btn_loading.hide("edit");
                dialog.show("Sửa " + title, result);
            });
        },
        show: function (url, title) {
            btn_loading.loading("show");
            $.get(url, null, function (result) {
                btn_loading.hide("show");
                dialog.show("Thông tin " + title, result);
            });
        },
        addCommas: function(nStr){
            nStr += '';
            let x = nStr.split('.');
            let x1 = x[0];
            let x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    };
})();

var changeStatus = (url, status, __callback) => {
    $.ajax({
        method: 'POST',
        url: url,
        type: 'json',
        data: {
            'status': status
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {

            if (response.status == 'success') {
                toastr.success(response.message);
            } else if (response.status == 'error') {
                toastr.error(response.message)
            }
            __callback(true)
        },
        error: function(xhr, ajaxOptions, thrownError) {
            toastr.error(xhr.responseJSON.message)
            __callback(false)
        }
    });
}

var renderError = (errors) => {
    for(var key in errors){
        $(`[name=${key}]`).addClass('is-invalid')
        $(`[name=${key}]`).next('.invalid-feedback').remove()
        $(`[name=${key}]`).after(`<span class="error invalid-feedback" style="display:block">${errors[key]}</span>`) ;
    };
}

var helperImage = (function () {
    return {
        upload: function (url, e, csrf_token, __callback, idUrlFile = '#input-url-file') {
            e.preventDefault();
            let formData = new FormData();
            formData.append('file', $('input[type=file]')[0].files[0]);
            formData.append('_token', csrf_token);
            $('#image-input-error').text('');
            $.ajax({
                type:'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        $(idUrlFile).val(response.file)
                        __callback(response.file)
                    }
                },
                error: function(response){
                    __callback(false)
                    $('#image-input-error').text(response.responseJSON.errors.file);
                }
            });
        },
        edit: function (e) {
            e.preventDefault();
            $('#input-photo-name').hide()
            $('#upload-image-form').show()
            $('input[name=photo]').val('')
        },
    };
})();

$(document).ready(function() {

    // jQuery.datetimepicker.setLocale('vi');
    // $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    // $('form input').keydown(function(e) {
    //     let dataPage = $('.content').attr('data-page');
    //     console.log(dataPage);
    //     if (e.keyCode == 13 && dataPage != 'patients_index') {
    //         e.preventDefault();
    //         return false;
    //     }
    // });
    //Initialize Select2 Elements
    $('.select2').select2();

    //format number
    // $('input.price').number(true, 0);

    // $('.datepicker').datetimepicker({
    //     format: 'Y-m-d',
    //     timepicker: false,
    //     scrollMonth: false,
    //     scrollInput: false
    // });

    // $('.timepicker').datetimepicker({
    //     format: 'H:i',
    //     datepicker: false,
    //     scrollMonth: false,
    //     scrollInput: false
    // });

    // $("input[data-bootstrap-switch]").each(function() {
    //     $(this).bootstrapSwitch('state', $(this).prop('checked'));
    // });

    // $('[data-toggle="tooltip"]').tooltip();

    // /////////////////////ROLES//////////////////////////////
    $('.js-checkbox-groups').click(function(e) {
        e.preventDefault();
        if ($(this).prev().is(':checked') === true) {
            $(this).closest('.card').find('.card-header input:checkbox').prop('checked', false);
            $(this).closest('.card').find('.card-body input:checkbox').prop('checked', false);
        } else {
            $(this).closest('.card').find('.card-header input:checkbox').prop('checked', true);
            $(this).closest('.card').find('.card-body input:checkbox').prop('checked', true);
        }
    });
    $('.js-checkbox-single').click(function(e) {
        e.preventDefault();

        if ($(this).prev().is(':checked') === true) {
            $(this).prev().prop('checked', false);
        } else {
            $(this).prev().prop('checked', true);
        }
        checkboxAll($(this).closest('.card').find('.card-body input:checkbox'), $(this).closest('.card').find('.card-header input:checkbox'));

    });
    /////////////////////END ROLES//////////////////////////////

    ///////////////////////////LIST/////////////////////////////
    $(document).on('click', '.js-checkbox-all', function (e) {
        e.preventDefault();
        const _this = $(this)

        if (_this.prev().is(':checked') === true) {
            $('.checkboxAll').prop('checked', false)
            $('.js-checkbox-list-single').each(function (){
                let classCheckbox = '.' + $(this).attr('for')
                $(classCheckbox).prop('checked', false)
            })
        } else {
            $('.checkboxAll').prop('checked', true)
            $('.js-checkbox-list-single').each(function (){
                let classCheckbox = '.' + $(this).attr('for')
                $(classCheckbox).prop('checked', true)
            })
        }
    })

    $(document).on('click', '.js-checkbox-list-single', function (e) {
        e.preventDefault();
        let classCheckbox = '.' + $(this).attr('for')
        const _this = $(this)

        if (_this.prev().is(':checked') === true) {
            $(classCheckbox).prop('checked', false)
        } else {
            $(classCheckbox).prop('checked', true)

        }
    })


    $('.js-checkbox-list-single').click(function(e) {
        e.preventDefault();

        if ($(this).prev().is(':checked') === true) {
            $(this).prev().prop('checked', false);
        } else {
            $(this).prev().prop('checked', true);
        }
        checkboxAll($(this).closest('table').find('tbody input:checkbox'), $(this).closest('table').find('thead input:checkbox'));

    });

    $('.js-edit-record').click(function(e) {
        e.preventDefault();
        let selected_itemm = false;
        let id = [];
        let url = $(this).data('url');
        let title = $(this).data('title');
        $($('table').find('tbody .icheck-info input:checkbox')).each(function(index, element) {
            if ($(element).is(':checked') === true) {
                selected_itemm = true;
                if(!id.includes(parseInt($(element).val())) ) {
                    id.push(parseInt($(element).val()));
                }
            }
        });
        if (selected_itemm === false) {
            dialog.alert('Không có bản ghi nào được chọn');
            return false;
        }

        if(id.length > 1){
            dialog.alert('Chỉ chọn 1 bản ghi để sửa');
            return false;

        }
        url = url.replace("0", id[0]);
        if($(this).prop('id') == 'edit'){
            helper.edit(url, title)
        }else{
            window.location.href = url;
        }

    });

    $('.js_select_multi_record_patient').click(function(e) {
        e.preventDefault();
        let selected_itemm = false;
        let id = [];
        let url = $(this).data('url');
        $($('.md-table-content').find('ul li .icheck-info input:checkbox')).each(function(index, element) {
            if ($(element).is(':checked') === true) {
                selected_itemm = true;
                id.push(parseInt($(element).val()));
            }
        });

        if (selected_itemm === false) {
            $.alert({
                title: 'Thông báo!',
                content: 'Không có bản ghi nào được chọn',
            });
            return false;
        }

        url = url.replace("0", id.join(','));
        window.location.href = url;
    });

    $('.js_select_one_record_patient').click(function(e) {
        e.preventDefault();
        let selected_itemm = false;
        let id = [];
        let url = $(this).data('url');
        $($('.md-table-content').find('ul li .icheck-info input:checkbox')).each(function(index, element) {
            if ($(element).is(':checked') === true) {
                selected_itemm = true;
                id.push(parseInt($(element).val()));
            }
        });
        if (selected_itemm === false) {
            $.alert({
                title: 'Thông báo!',
                content: 'Không có bản ghi nào được chọn',
            });
            return false;
        }
        if (id.length > 1) {
            $.alert({
                title: 'Thông báo!',
                content: 'Chỉ được chọn 1 bệnh nhân',
            });
            return false;
        }
        url = url.replace("0", id[0]);
        window.location.href = url;
    });

    $('.js_select_one_record').click(function(e) {
        e.preventDefault();
        let selected_itemm = false;
        let id = [];
        let url = $(this).data('url');
        $($('table').find('tbody .icheck-info input:checkbox')).each(function(index, element) {
            if ($(element).is(':checked') === true) {
                selected_itemm = true;
                id.push(parseInt($(element).val()));
            }
        });
        if (selected_itemm === false) {
            $.alert({
                title: 'Thông báo!',
                content: 'Không có bản ghi nào được chọn',
            });
            return false;
        }
        if (id.length > 1) {
            $.alert({
                title: 'Thông báo!',
                content: 'Chỉ được chọn 1 bệnh nhân',
            });
            return false;
        }
        url = url.replace("0", id[0]);
        window.location.href = url;
    });

    $('.js-delete-record').click(function(e) {
        e.preventDefault();
        let url = $(this).data('url');
        let id = $(this).data('id');
        let self = this;
        //dialog.confirm('Xác nhận', 'Bạn có chắc chắn muốn xóa bản ghi này?')
        if(confirm('Bạn có chắc chắn muốn xóa bản ghi này?')){
            delete_record(id, url, self);
        }
    });

    $('.js-delete-records').click(function(e) {
        e.preventDefault();
        let selected_itemm = false;
        let url = $(this).data('url');
        let arrId = [];
        $($('table').find('tbody .icheck-info input:checkbox')).each(function(index, element) {
            if ($(element).is(':checked') === true) {
                selected_itemm = true;
                arrId.push(parseInt($(element).val()));
            }
        });
        if (selected_itemm === false) {
            dialog.alert('Không có bản ghi nào được chọn')
            return false
        }
        dialog.confirm('Bạn có chắc chắn muốn xóa các bản ghi đã chọn ?', () => {
            delete_record(arrId, url);
        })
        // if(confirm('Bạn có chắc chắn muốn xóa các bản ghi đã chọn?')){
        //     delete_record(arrId, url);
        // }
    });

    $(document).on('switchChange.bootstrapSwitch', '.js_update_status', function (event, state){
        let url = $(this).data('action');
        if (!url) {
            return false;
        }
        status = state == true ? 1 : 0
        changeStatus(url, status)
    });

    ///////////////////////////END LIST/////////////////////////

    $('.add_member_button').click(function(e) {
        e.preventDefault();
        let key = Math.floor((Math.random() * 100000000) + 1);
        let item = '\
            <div class="row mb-3">\
                <div class="col-5">\
                    <input type="text" class="form-control" name="members[' + key + '][name]"\
                        placeholder="Họ tên">\
                </div>\
                <div class="col-5">\
                    <input type="text" class="form-control datepicker" name="members[' + key + '][birthday]"\
                        autocomplete="off" placeholder="Ngày sinh">\
                </div>\
                <div class="col-2">\
                    <button class="btn btn-sm btn-danger float-right remove_member_button" type="button"><i class="fas fa-trash"></i></button>\
                </div>\
            </div>\
        ';

        let addButton = $(this).closest('.add_member');
        $(item).insertBefore(addButton);

        $('.datepicker').datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            scrollMonth: false,
            scrollInput: false
        });
    });

    $(document).on('click', '.remove_member_button', function() {
        $(this).closest('.row').remove();
    });

    ///////////////////////CHECK CHANGE DATA////////////////////
    $(document).on('change', 'input, textarea',function (e) {
        if ($(this).val()) {
            $(this).css('color','#506fe4')
            $(this).css('border-color','#506fe4')
            $(this).css('background','unset')
            $(this).attr('data-inputted', 1)
            if ($(this).next().attr('class') == "error invalid-feedback") {
                $(this).next().hide()
                $(this).removeClass('is-invalid')
            }
            window.onbeforeunload = function () {
                return "";
            };
        } else {
            window.onbeforeunload = function () {
            }
            $(this).css('color','#8A98AC')
            $(this).css('border-color','#0000004d')
            $(this).attr('data-inputted', 0)
        }
    })

    $(document).on('submit', 'form',function (e) {
        window.onbeforeunload = function () {
        }
    })

    ///////////////////////////PATTERN/////////////////////////////
    $(document).on('click', '.js-checkbox-all-pattern', function (e) {
        e.preventDefault();
        const _this = $(this)

        if (_this.prev().is(':checked') === true) {
            $('.checkboxAllPattern').prop('checked', false)
            $('.js-checkbox-list-single-pattern').each(function (){
                let classCheckbox = '.' + $(this).attr('for')
                $(classCheckbox).prop('checked', false)
            })
        } else {
            $('.checkboxAllPattern').prop('checked', true)
            $('.js-checkbox-list-single-pattern').each(function (){
                let classCheckbox = '.' + $(this).attr('for')
                $(classCheckbox).prop('checked', true)
            })
        }
    })

    $(document).on('click', '.js-checkbox-list-single-pattern', function (e) {
        e.preventDefault();
        let classCheckbox = '.' + $(this).attr('for')
        const _this = $(this)

        if (_this.prev().is(':checked') === true) {
            $(classCheckbox).prop('checked', false)
        } else {
            $(classCheckbox).prop('checked', true)

        }
    })

    $('.js-checkbox-list-single-pattern').click(function(e) {
        e.preventDefault();

        if ($(this).prev().is(':checked') === true) {
            $(this).prev().prop('checked', false);
        } else {
            $(this).prev().prop('checked', true);
        }
        checkboxAll($(this).closest('table').find('tbody input:checkbox'), $(this).closest('table').find('thead input:checkbox'));
    });

    ///////////////////////////PROCESS/////////////////////////////
    $(document).on('click', '.js-checkbox-all-process', function (e) {
        e.preventDefault();
        const _this = $(this)

        if (_this.prev().is(':checked') === true) {
            $('.checkboxAllProcess').prop('checked', false)
            $('.js-checkbox-list-single-process').each(function (){
                let classCheckbox = '.' + $(this).attr('for')
                $(classCheckbox).prop('checked', false)
            })
        } else {
            $('.checkboxAllProcess').prop('checked', true)
            $('.js-checkbox-list-single-process').each(function (){
                let classCheckbox = '.' + $(this).attr('for')
                $(classCheckbox).prop('checked', true)
            })
        }
    })

    $(document).on('click', '.js-checkbox-list-single-process', function (e) {
        e.preventDefault();
        let classCheckbox = '.' + $(this).attr('for')
        const _this = $(this)

        if (_this.prev().is(':checked') === true) {
            $(classCheckbox).prop('checked', false)
        } else {
            $(classCheckbox).prop('checked', true)

        }
    })

    $('.js-checkbox-list-single-process').click(function(e) {
        e.preventDefault();

        if ($(this).prev().is(':checked') === true) {
            $(this).prev().prop('checked', false);
        } else {
            $(this).prev().prop('checked', true);
        }
        checkboxAll($(this).closest('table').find('tbody input:checkbox'), $(this).closest('table').find('thead input:checkbox'));
    });
    ///////////////////////////LIST NOT DATA TABLE/////////////////////////////
    $(document).on('click', '.js-checkbox-all-not-datatable', function (e) {
        e.preventDefault();
        const _this = $(this)

        if (_this.prev().is(':checked') === true) {
            $('.checkboxAllNotDataTable').prop('checked', false)
            $('.js-checkbox-list-single-not-datatable').each(function (){
                let classCheckbox = '.' + $(this).attr('for')
                $(classCheckbox).prop('checked', false)
            })
        } else {
            $('.checkboxAllNotDataTable').prop('checked', true)
            $('.js-checkbox-list-single-not-datatable').each(function (){
                let classCheckbox = '.' + $(this).attr('for')
                $(classCheckbox).prop('checked', true)
            })
        }
    })

    $('.js-checkbox-list-single-not-datatable').click(function(e) {
        e.preventDefault();

        if ($(this).prev().is(':checked') === true) {
            $(this).prev().prop('checked', false);
        } else {
            $(this).prev().prop('checked', true);
        }
        checkboxAll($(this).closest('table').find('tbody input:checkbox'), $(this).closest('table').find('thead input:checkbox'));
    });
    /////////////////////////OPEN MENU HEADER///////////////////////////
    $('.dropdown-toggle').on('click', function (e) {
        e.preventDefault();
        $('.dropdown').addClass('show')

    })
});
