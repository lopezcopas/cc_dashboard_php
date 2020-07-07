//Globals
var orderNumber,
    orderTitle;

$(document).ready(async () => {
    async function orderGen(){
        orderNumber = Math.floor(Math.random() * (9999999 - 1000000)) + 1000000;
        await validateordernumber(orderNumber)
        .then(data =>{
            if(data.Status == 208){
                orderGen();
            }else{
                $('.order-number').html(`C-${orderNumber}`);
            }
        });
    }
    orderGen();

    //Fill in today's date
    if($('input[name="takenDate"]').val() == ''){
        var today = new Date().toISOString();
        today = today.substring(0, today.length-1);
        $('input[name="takenDate"]').val(today);
    }
});

//ORDER NAME
$('#order-title').click(() => {
    $('#order-title').html('<input id="editable-title">');
    $('#editable-title').focus();
});

$(document).on('blur', '#editable-title', () => {
    if($('#editable-title').val().replace(' ', '').length < 1){
        if(orderTitle == null){
            $('#order-title').html('Click to edit...');
        }else{
            $('#order-title').html(orderTitle);
        }
    }else{
        orderTitle = $('#editable-title').val();
        $('#order-title').html(orderTitle);
    }
});

//ORDER NUMBER
$('.order-number').click(() => {
    $('.order-number').html('C-<input id="editable-order-number">');
    $('#editable-order-number').focus();
    $('.order-number').css('color', '#777');
});

$(document).on('keyup', '#editable-order-number', () => {
    if($('#editable-order-number').val().replace(/\D+/g, "").length == 7){
        $(event.target).blur();
    }
});

$(document).on('blur', '#editable-order-number', async () => {
    if($('#editable-order-number').val().replace(/\D+/g, "").length < 7){
        $('.order-number').html(`C-${orderNumber}`);
    }else{
        await validateordernumber(`C-${$('#editable-order-number').val().replace(/\D+/g, "")}`)
        .then(data => {
            if(data.Status != 208){
                orderNumber = $('#editable-order-number').val().replace(/\D+/g, "");
                $('.order-number').html(`C-${orderNumber}`);
            }else{
                $('.order-number').html(`C-${orderNumber}`);
                $('.order-number').css('color', 'red');
            }
        });
    }
});

//VALIDATE ORDER NUMBER
async function validateordernumber(orderNumber){
    let response = await fetch('./php/gets/validateorderid.php',{
        method:'post',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            'OrderID':orderNumber
        }),
        mode:'cors'
    });

    let data = await response.json();

    return data;
}