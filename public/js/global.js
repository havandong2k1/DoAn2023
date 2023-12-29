var Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000
});
/*format currency in USD*/
function formatCurrencyByUSD(num){
	var strNum = num.toString().replaceAll(",", "");
	if($.isNumeric(strNum)==false){
		return "false";
	}
	var numFM = Number(strNum);
    if (numFM <0) {
        return "false_0";//Not permit < 0
    }
	var roundedNum = numFM.toFixed(2);
	var before = roundedNum.toString();
	var after = "00";
	if(roundedNum.indexOf(".") > 0) {
		var parts = roundedNum.split(".");
		before = parts[0];
		after = parts[1];
	}
	if(before!=""){
		before = before.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
	}
	var result = before+"."+after;
	return result;
}
function formatCurrencyByVND(num){
	var strNum = num.toString().replaceAll(",", "");
	if($.isNumeric(strNum)==false){
		return "false";
	}
	var numFM = Number(strNum);
	if (numFM <0) {
		return "false_0";//Not permit < 0
	}
	var roundedNum = numFM.toFixed(2);
	var before = roundedNum.toString();

	if(roundedNum.indexOf(".") > 0) {
		var parts = roundedNum.split(".");
		before = parts[0];
	}
	if(before!=""){
		before = before.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
	}
	var result = before;
	return result;
}
/*@params:
* baseValue, baseDevices, appendDevices, appendMonths, priceOnABlock as number
* @result: baseValue + increaseValue as number
*/
function appendValues(baseValue, baseDevices, appendDevices, appendMonths, priceOnABlock){
	var increaseValue = 0;
	if(appendDevices > 0 || appendMonths > 0){
		increaseValue = 1;
		if(appendDevices > 0){
			increaseValue = increaseValue * appendDevices/baseDevices;
		}
		if(appendMonths > 0){
			increaseValue = increaseValue * appendMonths;
		}
		increaseValue = increaseValue * priceOnABlock;
	}
	var result = baseValue * 1 + increaseValue;
	return result;
}

$(document).ready(function (){
	//format on load
	var currencyValue =$("#input_currency").val();
	if(currencyValue!=null){
		currencyValue =formatCurrencyByUSD(currencyValue);
		if(currencyValue!="false"){
			$("#input_currency").val(currencyValue);
		}
	}
	//on change with input_currency on the view
	$("#input_currency").change(function(){
		var myValue = $(this).val();
		myValue =formatCurrencyByUSD(myValue);
		if(myValue=="false"){
			$("#lbl_input_currency").text("Giá trị sai định dạng");
			$("#lbl_input_currency").css('color', 'red');
			$("#lbl_input_currency").css('font-style', 'italic');
			return;
		}
		$("#input_currency").val(myValue);
	});
	//end-of
	//For loading date-picker
	//Check exist class to do
	if ($('.js__date-picker').length > 0) {
		$('.js__date-picker').datepicker({
			format: 'dd-mm-yyyy',
		});
	}

	$('.choose__all').click(function () {
		if ($(this).is(':checked') == true) {
			$('.input__check').prop('checked', true);
		} else {
			$('.input__check').prop('checked', false);
		}
	});
	//End-of

	// add new input key language
	var key = 1;
	$('.btn__new-key').click(function () {
		key += 1;

		var append_content = '<div class="form-row">\n' +
			'                        <div class="form-group col-md-3">\n' +
			'                            <label for="inputKey' + key + '">Từ khóa</label>\n' +
			'                            <input type="search" name="lang_key[]" placeholder="service..." required class="form-control" id="inputKey' + key + '">\n' +
			'                        </div>\n' +
			'                        <div class="form-group col-md-4">\n' +
			'                            <label for="inputValueEN' + key + '">Giá trị tiếng anh</label>\n' +
			'                            <input type="search" name="lang_value_en[]" required placeholder="service..." class="form-control" id="inputValueEN' + key + '">\n' +
			'                        </div>\n' +
			'                        <div class="form-group col-md-4">\n' +
			'                            <label for="inputValueVN' + key + '">Giá trị tiếng việt</label>\n' +
			'                            <input type="search" name="lang_value_vn[]" required placeholder="dịch vụ..." class="form-control" id="inputValueVN' + key + '">\n' +
			'                        </div>\n' +
			'                        <div class="form-group col-md-1">\n' +
			'                            <label for="">&nbsp;</label>\n' +
			'                            <i class="d-block fas fa-times js__hide-input" style="color: red;margin: 10px 0 0 10px;cursor: pointer;font-size: 20px;"></i>\n' +
			'                        </div>\n' +
			'                    </div>'
		$('.js__div-after').after(append_content);
		$('#numberKey').val(key);
	})
	// delete lang code
	$('.btn__delete-language-code').click(function () {
		var lang_code_list = [];
		$(".input__check").each(function () {
			if ($(this).is(":checked")) {
				lang_code_list.push($(this).attr('data-id'));
			}
		});
		if (lang_code_list.length <= 0) {
			Toast.fire({
				icon: 'warning',
				title: 'Vui lòng chọn ít nhất 1 bản ghi!'
			});
			return;
		}
		var result = confirm("Xác nhận xóa bản ghi?");
		if (result) {
			$('#listlanguageCodeId').val(lang_code_list);
			$('.list_language_code_id').submit();
		}
	});

	$('.btn__delete-language').click(function () {
		var lang_list = [];
		$(".input__check").each(function () {
			if ($(this).is(":checked")) {
				lang_list.push($(this).attr('data-language-id'));
			}
		});
		if (lang_list.length <= 0) {
			Toast.fire({
				icon: 'warning',
				title: 'Vui lòng chọn ít nhất 1 bản ghi!'
			});
			return;
		}
		var result = confirm("Xác nhận xóa ngôn ngữ?");
		if (result) {
			$('#listLanguageId').val(lang_list);
			$('.list_language_id').submit();
		}
	})

	// hide input
	$('body').delegate('.js__hide-input', 'click', function () {
		// key -= 1;
		// $(this).parent().parent().remove();
		// $('#numberKey').val(key);
		var key = $(this).attr('data-key');
		$('.select-num-'+key).remove();
		$('.input-num-'+key).remove();
		$(this).remove();
	})
	// random passs
	$('body').delegate('.js__random-password','click',function () {
		$('#inputPasswordAdmin, #inputPasswordAdminConfirm').get(0).type = 'text';
		var value = makeRandom(16);
		$('#inputPasswordAdmin').val(value);
		$('#inputPasswordAdminConfirm').val(value);
	})
	function makeRandom(length) {
		var result           = '';
		var characters       = '!@#$%^&*ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		var charactersLength = characters.length;
		for ( var i = 0; i < length; i++ ) {
			result += characters.charAt(Math.floor(Math.random() *
				charactersLength));
		}
		return result;
	}
});
