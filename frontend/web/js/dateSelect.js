$.fn.getDateSelect = function(year, month){
    var days = 30;
    var dateCert = this.val();
    if (month == 2){
        if(year == 0) {
            days = 29;
        } else {
            var isLeap = year % 400 === 0 || year % 100 !== 0 && year % 4 === 0 ? true : false;
            days = isLeap ? 29 : 28;
        }
    } else {
        if(month == 0 || month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12){
            days = 31;
        }
    }
    this.find('option[value!="0"]').remove();
    this.initDateSelect(1, days);
    if(parseInt(this.find('option:last').val()) < dateCert){
        this.val(0);
    } else {
        this.val(dateCert);
    }
}
$.fn.initDateSelect = function(from, to){
    for(var i = from; i <= to; i++){
        this.prepend('<option value="' + i + '">' + i + '</option>');
    }
    
    this.styler({
        selectVisibleOptions:10, // Кол-во отображаемых пунктов в селекте без прокрутки.
        onSelectOpened: function() {
            $(this).css('width', '100%');
        }
    });
}
$(function () {
    var initBirthYear = 0;
    var initBirthMonth = 0;
    var initBirthDay = 0;
    var d = new Date();
    $('#birthDay').prepend('<option value="0">ДД</option>');
    $('#birthMonth').prepend('<option value="0">ММ</option>');
    $('#birthYear').prepend('<option value="0">ГГГГ</option>');
    $('#birthYear').initDateSelect(1920, (d.getFullYear() - 18));
    $('#birthYear').val(initBirthYear);
    $('#birthMonth').initDateSelect(1, 12);
    $('#birthMonth').val(initBirthMonth);
    $('#birthDay').getDateSelect($('#birthYear').val(), $('#birthMonth').val());
    $('#birthDay').val(initBirthDay);
    $('#birthYear, #birthMonth').change(function(){
        $('#birthDay').getDateSelect($('#birthYear').val(), $('#birthMonth').val());   
    });

    $(".select_type_1").styler({
        selectVisibleOptions: 10,
        onSelectOpened: function() {
            $(this).css('width', '100%');
        }
    });
});