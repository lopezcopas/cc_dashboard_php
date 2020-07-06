let currentUser = 'Someone';

$(document).ready(async function(){
    //Get Possible Status
    await loadstatuses()
    .then(data=>{
        if(data.Status == 200){
            statuses = data.Response;
        }
    });
    //Load Order List
    loadorders()
    .then(data=>{
        if(data.Status != 200){
            return;
        }else{
            data = data.Response;
        }
        data.forEach((order, index)=>{
            var date = new Date(order['DueDate']),
                currentDate = new Date();
            var elm = $('#hidden-order').clone();
            elm.attr('id', '');
            elm.attr('orderid', order['OrderID']);
            elm.find('.ol-order').html(order['OrderID']);
            elm.find('.ol-order').attr('href', `./orders.php?order=${data['OrderID']}`);
            elm.find('.ol-date-date').html(`${date.getDate()} ${date.toLocaleString('default', {month: 'long'})}, ${date.getFullYear()}`);
            elm.find('.ol-date-time').html(date.toLocaleString('default', {hour: 'numeric', minute:'numeric', hour12: true}));
            if(date < currentDate && order['Status'].split(' ')[0] != 'Shelf'){
                elm.css('background-color', 'rgb(255, 200, 200)');
                elm.find('.ol-date-date').css('color', '#fff');
                elm.find('.ol-date-time').css('color', '#fff');
            }
            elm.find('.ol-customer-name').html(`${order['Customer']['First']} ${order['Customer']['Last']}`);
            if(order['Customer']['OrganizationName']){
                elm.find('.ol-customer-organization').html(order['Customer']['OrganizationName']);
            }
            elm.find('.ol-status').html(order['Status']);
            if(statuses){
                statuses.forEach(status => {
                    if(order['Status'] == status['status']){
                        elm.find('.ol-status').css('color', `${status['color']}`);
                    }
                });
            }
            elm.find('.ol-user').html(order['CurrentUser']);
            elm.find('.ol-payment').html(order['PaymentStatus']);
            if(order['PaymentStatus'] == 'Pending'){
                elm.find('.ol-payment').css('color', 'rgb(200, 180, 0)');
            }else if(order['PaymentStatus'] == 'Paid'){
                elm.find('.ol-payment').css('color', 'rgb(10, 200, 0)');
            }
            elm.find('.ol-total').html(`$ ${order['Total']}`);
            elm.appendTo('.order-list-body');
        });
    });
});

async function loadstatuses(){
    let url = `./php/gets/getstatuses.php`;
    let response = await fetch(url, {
        method: 'Post',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers:{
            'Content-Type': 'application/json'
        }
    });
    let data = await response.json();
    return data;
}

async function loadorders(){
    let url = `./php/gets/getorderlist.php`;
    let response = await fetch(url, {
        method: 'Post',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers:{
            'Content-Type': 'application/json'
        }
    });
    let data = await response.json();
    return data;
}

$(document).on('click', '.order', function(){
    location = `./orders.php?order=${$(event.target).attr('orderid')}`;
});


//NEW ORDER
$('#new-order').click(function(){
    $('.section').each(function(index, value){
        $(value).css('display', 'none');
    });
    //Generate Order Number
    var validID = false,
        orderID;
    //Generate Order ID
    async function validate(){
        while(validID == false){
            min = Math.ceil(1);
            max = Math.floor(9999999);
            orderID = Math.floor(Math.random() * (max - min + 1)) + min;
            let data = await validateorderid(`C-${orderID}`);
            if(data.Status != 208){
                //Valid ID
                validID = true;
            }
        }
    }
    validate();
    $('#new-order-id').val(`C-${orderID}`);
    $('.new-order-section').css('display', 'flex');
});

async function validateorderid(orderID){
    let response = await fetch('./php/gets/validateorderid.php',{
        method:'post',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            'OrderID':orderID
        }),
        mode:'cors'
    });

    let data = await response.json();

    return data;
}

$('#editable-title').click(function(){
    $(event.target).html(`<input autofocus name="order-title" type=text class="card-title-input">`);
});

$(document).on('blur', '.card-title-input', function(){
    var name = $(event.target).val().replace(' ', '');
    if(name.length == 0){
        $('#editable-title').html('New Order');
    }
});

$('#new-order-id').focus(function(){
    $('#new-order-id').val('C-');
    $('#new-order-id').css('color', '#555');
    $('#new-order-id').css('font-weight', 'normal');
});

$('#new-order-id').keyup(function(){
    if($('#new-order-id').val().length == 9){
        validateorderid($('#new-order-id').val())
        .then(data=>{
            if(data.Status != 208){
                $('#new-order-id').blur();
            }else{
                $('#new-order-id').css('color', 'red');
                $('#new-order-id').css('font-weight', 'bold');
            }
        });
    }else{
        $('#new-order-id').css('color', '#555');
        $('#new-order-id').css('font-weight', 'normal');
    }
});

//Expand Item
$(document).on('click', '.item-collapsed', function(){
    if($(event.target).closest('.item').hasClass('expanded')){
        $(event.target).closest('.item').removeClass('expanded');
        $(event.target).find('.item-body').css('display', 'none');
        $(event.target).closest('.item').css('height', '60px');
    }else{
        $(event.target).closest('.item').addClass('expanded');
        if($(event.target).closest('.item').attr('itemtype') == 'Printing'){
            $(event.target).find('.printing-section').css('display', 'block');
        }
        $(event.target).closest('.item').css('height', 'auto');
    }
});

$(document).on('click', function(){
    console.log(event.target);
});