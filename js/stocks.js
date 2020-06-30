$(document).ready(async function(){
    await getstocks()
    .then(data=>{
        if(data.Status != 200){
            return;
        }
        var stocks = data.Response;
        stocks.forEach(stock=>{
            //Add Stocks to list
            var elm = $('#hidden-stock').clone();
            elm.attr('id', '');
            elm.attr('stockid', stock['ID']);
            elm.find('.description').html(stock['Description']);
            elm.find('.width').html(stock['Width']);
            elm.find('.height').html(stock['Height']);
            elm.find('.type').html(stock['Type']);
            elm.find('.coating').html(stock['Coating']);
            elm.appendTo($('.sl-body'));
        });
    });
});

async function getstocks(sort=null){
    let url = './php/gets/getstocklist.php';
    let response = await fetch(url, {
        method: 'Post',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers:{
            'Content-Type': 'application/json'
        },
        body:JSON.stringify({
            'sort':sort
        })
    });
    let data = await response.json();
    return data;
}

//Open Stock Editor Popup - NEW
$('#add-stock').click(function(){
    $('.popup').css('display', 'flex');
    $('.stock-editor').find('.card-title').html('New Stock');
});

//Open Stock Editor Popup - EDIT
$(document).on('click', '.stock-edit', async function(){
    await getstock($(event.target).closest('.stock').attr('stockid'))
    .then(data=>{
        if(data.Status != 200){
            return;
        }
        var stock = data.Response;
        $('.popup').css('display', 'flex');
        $('.stock-editor').find('.card-title').html('Edit Stock');
    });
});

async function getstock(stockid){
    let url = './php/gets/getstock.php';
    let response = await fetch(url, {
        method: 'Post',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers:{
            'Content-Type': 'application/json'
        },
        body:JSON.stringify({
            'stockid':stockid
        })
    });
    let data = await response.json();
    return data;
}

$(document).on('click', '.modal', function(){
    $('.popup').css('display', 'none');
});