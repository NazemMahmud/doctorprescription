/**
 * Created by Nazem Mahmud on 11/7/2017.
 */
/*function fill(Value) {
    $('#search').val(Value);

    //Hiding "display" div in "search.php" file.

    $('#display').hide();

}
*/
$(document).ready(function() {
    // $.ajax({
    //     type: "POST",
    //     url: "ajax.php",
    //     data: {
    //         search: name
    //     },
    //     success: function(html) {                  //If result found, this funtion will be called.
    //         $("#display").html(html).show();
    //     }
    // });

    $("#which_doc").keyup(function() { //On pressing a key on This function will be called

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var name = $('#which_doc').val();
        var _token = $("#token").val();
        if (name == "") {
            $("#searchbox").html("");
        }
        else {
            $.post( "ajax", { token: _token, name: name },
                function( data ) {
                    // console.log( "ajax working");
                    $('#searchbox').html(data.html);
                }, "json");

        }
    });
});