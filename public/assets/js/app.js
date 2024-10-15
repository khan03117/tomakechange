const get_sub_category = (e) => {
    let id = e.target.value;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post(`${url}/ajax/get_sub_category`, { id: id }, function (res) {
        $("#sub_category").html(res);
    })
}
const getCityByState = (e) => {
    let id = e.target.value;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post(`${url}/ajax/getCityByState`, { id: id }, function (res) {
        $("#cities").html(res);
        $("#form_state").val(id);
    })
}
$('input.nospace').keydown(function (e) {
    if (e.keyCode == 32) {
        return false;
    }
});

