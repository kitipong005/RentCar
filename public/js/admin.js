$(function(){
    //-------- active side ------------
    var path = window.location.pathname.split("/").pop();
    var target = 'http://127.0.0.1:8000/'+path
    console.log(path);
    if(path == 'admin')
    {
        $('#admin').addClass('active');
    }
    else if(path == 'admin-addcar')
    {
        $('#car').addClass('active');
    }
    else if(path == 'admin-listcar')
    {
        $('#car').addClass('active');
    }
    else if(path == 'admin-brand')
    {
        $('#car').addClass('active');
    }
    else if(path == 'admin-type')
    {
        $('#car').addClass('active');
    }
    else if(path == 'admin-model')
    {
        $('#car').addClass('active');
    }
    else if(path == 'admin-time')
    {
        $('#car').addClass('active');
    }
    else if(path == 'admin-returncar')
    {
        $('#car').addClass('active');
    }
    else if(path == 'admin-landmark')
    {
        $('#landmark').addClass('active');
    }
    else if(path == 'admin-attraction')
    {
        $('#attraction').addClass('active');
    }
    else if(path == 'admin-formattraction')
    {
        $('#attraction').addClass('active');
    }
    else if(path == 'admin-confirm-book')
    {
        $('#book').addClass('active');
    }
    else if(path == 'admin-confirm-pdf')
    {
        $('#book').addClass('active');
    }
    else if(path == 'admin-confirm-success')
    {
        $('#book').addClass('active');
    }
    
    //------- car add ---------
    let v = $('#type option:selected').text();
    if(v == 'motorcycle')
    {
        $('#door').attr('disabled','disabled');
        $('#air').attr('disabled','disabled');
        $('#door').val('');
        $('#air').val('no');
        changeType()
    }
    else if(v == 'car')
    {
        $('#door').removeAttr('disabled','').attr('required','required');
        $('#air').removeAttr('disabled','').attr('required','required');
        $('#door').val('');
        $('#air').val('no');
        changeType()
    }
    else
    {
        $('#door').removeAttr('disabled','');
        $('#air').removeAttr('disabled','');
        changeType()
    }
});
function changeType()
{
    $('#type').change(function(){
        let value = $('#type option:selected').text();
        if(value == 'motorcycle')
        {
            $('#door').attr('disabled','disabled');
            $('#air').attr('disabled','disabled');
        }
        else
        {
            $('#door').removeAttr('disabled','');
            $('#air').removeAttr('disabled','');
            $('#door').removeAttr('disabled','').attr('required','required');
            $('#air').removeAttr('disabled','').attr('required','required');
        }
    });
}
function changeBrand()
{
    let brand = $('#brand option:selected').val();
    console.log(brand);
    $.ajax({
        method: "GET",
        url:"/list-model",
        data:{
            'id': brand,
        },
        dataType: "json",
        async: false,
        success: function(data){
            console.log(data);
            var mo = $('#model option:selected');
            // console.log(mo)
            if(data.length > 0){
                $('#model').removeAttr('disabled');
                //$('#model option:selected').selectmenu().selectmenu('refresh',true);
                $('#model').html('<option disabled selected>--- please select -----</option>'
                +data.map(e=>'<option value=' + e.id + '>' + e.name + '</option>').join(''));
                
            }
            else {
                $('#model').attr('disabled','disabled');
            }
        }
    });
}