let currentUser = 'Copas';

$(document).ready(function(){
    //Get Possible Status
    loadstatuses()
    .then(data=>{
        statuses = data;
    });
    //Load Order List
    loadorders()
    .then(data=>{
        data.forEach((order, index)=>{
            var date = new Date(order['DueDate']);
            var elm = $('#hidden-order').clone();
            elm.attr('id', '');
            elm.attr('orderid', order['OrderID']);
            elm.find('.ol-order').html(order['OrderID']);
            elm.find('.ol-date-date').html(`${date.getDate()} ${date.toLocaleString('default', {month: 'long'})}, ${date.getFullYear()}`);
            elm.find('.ol-date-time').html(date.toLocaleString('default', {hour: 'numeric', minute:'numeric', hour12: true}));
            elm.find('.ol-customer-name').html(`${order['Customer']['First']} ${order['Customer']['Last']}`);
            if(order['Customer']['OrganizationName']){
                elm.find('.ol-customer-organization').html(order['Customer']['OrganizationName']);
            }
            elm.find('.ol-status').html(order['Status']);
            if(statuses){
                statuses.forEach(status => {
                    if(order['Status'] == status['Status']){
                        elm.find('.ol-status').css('color', `${status['Color']}`);
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
    let url = `./testers/json/statuses.json`;
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

//New Current Order
$(document).on('click', '.order', function(){
    if(!$(event.target).hasClass('order')){
        return;
    }

    var orderid = $(event.target).attr('orderid');

    //Set Current Order
    getorder(orderid)
    .then(data=>{
        if(data['OrderName']){
            $('.current-order-card').find('.card-title').html(`Order | ${orderid} | ${data['OrderName']}`);
        }else{
            $('.current-order-card').find('.card-title').html(`Order | ${orderid}`);
        }
        //Current User
        if(data['CurrentUser']){
            $('.co-user').find('span').html(data['CurrentUser']);
            $('.co-user').find('span').css('color', '#555');
            if(data['CurrentUser'] != currentUser){
                $('.co-user').find('span').css('color', '#ff3c3c');
            }
        }else{
            $('.co-user').find('span').html(currentUser);
            $('.co-user').find('span').css('color', '#555');
            updateuser(orderid);
        }

        //Customer Info
        $('.current-order-card').find('.name').find('span').html(`${data['Customer']['First']} ${data['Customer']['Last']}`);
        if(data['Customer']['Organization']){
            $('.current-order-card').find('.organization').find('span').html(data['Customer']['Organization']['Name']);
        }else{
            $('.current-order-card').find('.organization').find('span').html('');
        }
        $('.current-order-card').find('.phone').find('span').html(data['Customer']['Phone'][0]['PhoneNumber']);
        $('.current-order-card').find('.email').find('span').html(data['Customer']['Email'][0]['EmailAddress']);

        //Dates
        $('.current-order-card').find('.takendate').val(data['TakenDate']);
        if(data['ProofDate']){
            $('.current-order-card').find('.proofdate').val(data['ProofDate']);
        }else{
            $('.current-order-card').find('.proofdate').val('');
        }
        if(data['DueDate']){
            $('.current-order-card').find('.duedate').val(data['DueDate']);
        }else{
            $('.current-order-card').find('.duedate').val('');
        }

        //Items
        $('.current-order-card').find('.co-items').children().remove();
        data['Items'].forEach(item=>{
            var elm = $('#hidden-item').clone();
            elm.attr('id', '');
            elm.attr('itemid', `${item['ID']}`);
            elm.attr('itemtype', `${item['Type']}`);
            elm.find('.co-item-name').html(item['Name']);
            if(item['Status'] == 'Complete'){
                elm.find('.co-complete').css('color', 'rgb(10, 200, 0)');
            }
            if(item['Type'] == 'Printing'){
                elm.find('.co-item-description').html(`${item['Type']} | ${item['Width']}x${item['Height']}`);
                if(item['Note']){
                    elm.find('.note').html(item['Note']);
                }
                if(item['Duplex']){
                    elm.find('.print').html(`${item['Quantity']} Count | ${item['Width']}x${item['Height']} | ${item['Stock']} | DS | ${item['Color']}`);
                }else{
                    elm.find('.print').html(`${item['Quantity']} Count | ${item['Width']}x${item['Height']} | ${item['Stock']} | SS | ${item['Color']}`);
                }
            }else if(item['Type'] == 'Shipping'){
                if(item['AddressLineTwo']){
                    elm.find('.addresslineone').html(`${item['AddressLineOne']}, ${item['AddressLineTwo']}`);
                }else{
                    elm.find('.addresslineone').html(item['AddressLineOne']);
                }
                elm.find('.addresslinetwo').html(`${item['City']}, ${item['State']} ${item['Zip']}`);
            }else{
                elm.find('.co-item-description').html(item['Type']);
                if(item['Note']){
                    elm.find('.note').html(item['Note']);
                }
                if(item['Duplex']){
                    elm.find('.print').html(`${item['Quantity']} Count | ${item['Width']}x${item['Height']} | ${item['Stock']} | DS | ${item['Color']}`);
                }else{
                    elm.find('.print').html(`${item['Quantity']} Count | ${item['Width']}x${item['Height']} | ${item['Stock']} | SS | ${item['Color']}`);
                }
            }
            elm.appendTo('.co-items');
        });
        $('.current-order-card').find('.location').focus();
    });

    //Expand Current Order
    $('.current-order-card').css('display', 'block');
    $('.order-list-card').css('height', '400px');
});

async function getorder(orderid){
    let url = `./testers/json/${orderid}.json`;
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

async function updateuser(orderid){
    console.log(`Update the user to ${currentUser}`);
}

//Expand Item
$(document).on('click', '.co-item', function(){
    if(!$(event.target).hasClass('co-item')){
        return;
    }

    if($(event.target).hasClass('expanded')){
        $(event.target).removeClass('expanded');
        $(event.target).css('height', '60px');
        $(event.target).find('.co-item-shipping').css('display', 'none');
        $(event.target).find('.co-item-print').css('display', 'none');
    }else{
        $(event.target).addClass('expanded');
        //Expand Item
        if($(event.target).attr('itemtype') == 'Shipping'){
            $(event.target).find('.co-item-shipping').css('display', 'block');
        }else{
            $(event.target).find('.co-item-print').css('display', 'block');
        }
        $(event.target).css('height', 'auto');
    }
});