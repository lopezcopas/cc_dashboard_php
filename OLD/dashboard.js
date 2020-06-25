let CurrentUser = 'Copas';

$(document).ready(function(){
    loadOrders()
    .then(data=>{
        //Clone Blank Order
        data.forEach((order, index)=>{
            var date = new Date(order['DueDate']);
            var elm = $('#hidden-order').clone();
            elm.attr('id', '');
            elm.attr('orderid', order['OrderID']);
            elm.find('.order-number-text').html(order['OrderID']);
            elm.find('.order-number-text').attr('href', `./orders.php?order=${order['OrderID']}`);
            elm.find('.order-date-text').html(`${date.getDate()} ${date.toLocaleString('default', {month: 'long'})}, ${date.getFullYear()}`);
            elm.find('.order-time-text').html(date.toLocaleString('default', {hour: 'numeric', minute:'numeric', hour12: true}));
            elm.find('.customer-name-text').html(`${order['Customer']['First']} ${order['Customer']['Last']}`);
            if(order['Customer']['OrganizationName']){
                elm.find('.customer-organization-text').html(order['Customer']['OrganizationName']);
            }
            elm.find('.order-status-text').html(order['Status']);
            if(order['Status'] == 'Printing'){
                elm.find('.order-status-text').css('color', 'rgb(200,0,200)');
            }else if(order['Status'] == 'Layout'){
                elm.find('.order-status-text').css('color', 'rgb(200,150,0)');
            }else if(order['Status'] == 'Production'){
                elm.find('.order-status-text').css('color', 'rgb(150,0,0)');
            }
            if(order['CurrentUser']){
                elm.find('.order-user-text').html(order['CurrentUser']);
            }
            elm.find('.order-pay-status-text').html(order['PaymentStatus']);
            if(order['PaymentStatus'] == 'Pending'){
                elm.find('.order-pay-status-text').css('color', 'rgb(255,200,0)');
            }else if(order['PaymentStatus'] == 'Paid'){
                elm.find('.order-pay-status-text').css('color', 'rgb(15,200,0)');
            }
            elm.find('.order-total-text').html(`$ ${order['Total']}`);
            elm.appendTo('.order-table-body');
        });
    });
});

async function loadOrders(){
    let url = `./testers/json/orders.json`;
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

$(document).on('click', '.order-table-row', function(){
    if(!$(event.target).hasClass('order-table-row')){
        return;
    }
    OrderID = $(event.target).attr('OrderID');
    //Get Order
    getOrder(OrderID)
    .then(data=>{
        //Order ID
        $('.current-order-container').attr('OrderID', OrderID);
        //Customer Info
        $('.current-order-container').find('.card-title').html(`Order | ${OrderID} | ${data['Location']}`);
        $('#current-customer-name').html(`${data['Customer']['First']} ${data['Customer']['Last']}`);
        if(data['Customer']['Organization']){
            $('#current-customer-organization').html(data['Customer']['Organization']['Name']);
        }
        $('#current-customer-phone').html(data['Customer']['Phone'][0]['PhoneNumber']);
        $('#current-customer-email').html(data['Customer']['Email'][0]['EmailAddress']);
        $('#current-takendate').val(data['TakenDate']);
        $('#current-proofdate').val(data['ProofDate']);
        $('#current-duedate').val(data['DueDate']);
        if(data['CurrentUser'] && data['CurrentUser'] != CurrentUser){
            $('.order-editor').html(`Being edited by <span>${data['CurrentUser']}</span>`);
        }else if(data['CurrentUser'] && data['CurrentUser'] == CurrentUser){
            $('.order-editor').html(`Being edited by ${data['CurrentUser']}`);
        }else{
            $('.order-editor').html(`Being edited by ${CurrentUser}`);
        }
        //Order Items
        $('.current-order-items').children().remove();
        data['Items'].forEach((item, index)=>{
            var elm = $('#hidden-order-item').clone();
            elm.attr('id', item['ID']);
            elm.attr('ItemType', item['Type']);
            elm.find('.order-item-name').html(item['Name']);
            if(item['Status'] == 'Complete'){
                elm.find('.order-item-action-complete').addClass('order-item-action-complete-active');
            }
            if(item['Type'] != 'Shipping'){
                elm.find('.order-item-description').html(`${item['Type']} | ${item['Width']}x${item['Height']}`);
                if(item['Duplex']){
                    elm.find('.stock').html(`${item['Stock']} | DS | ${item['Color']}`);
                }else{
                    elm.find('.stock').html(`${item['Stock']} | SS | ${item['Color']}`);
                }
                elm.find('.note').html(item['Note']);
            }else{
                elm.find('.order-item-description').html(`${item['Type']}`);
                elm.find('.address-line-one').html(`${item['AddressLineOne']} ${item['AddressLineTwo']}`);
                elm.find('.city-state-zip').html(`${item['City']}, ${item['State']} ${item['Zip']}`);
            }
            
            elm.appendTo('.current-order-items');
        });
    });
    //Expand Current Order Section
    $('.current-order-container').find('.card-title').html(`Order | ${OrderID}`);
    $('.current-order-container').css({
        'height': '350px',
        'padding': '10px'
    });
    $('.order-new-location').focus();
    $('.order-list-container').css({
        'height': '410px'
    })
});

async function getOrder(OrderID){
    let url = `./testers/json/${OrderID}.json`;
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

$(document).on('click', '.order-item', function(){
    if($(event.target).hasClass('expanded')){
        $(event.target).removeClass('expanded');
        $(event.target).children().not(':eq(0)').css('display', 'none');
    }else{
        $(event.target).addClass('expanded');
        if($(event.target).attr('ItemType') == 'Printing'){
            $(event.target).find('.order-item-printing').css('display', 'flex');
        }else if($(event.target).attr('ItemType') == 'Shipping'){
            $(event.target).find('.order-item-shipping').css('display', 'flex');
        }
    }
});

$('.current-order-submit').on('click', function(){
    location = './dashboard.php';
});

$('.current-order-discard').on('click', function(){
    location = './dashboard.php';
});

$(document).on('click', '.order-item-action-edit', function(){
    location = `./orders.php?order=${$('.current-order-container').attr('orderid')}`;
});