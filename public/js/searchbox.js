/**
 * Created by Nazem Mahmud on 11/7/2017.
 */
function fill(Value) {
    $('#search').val(Value);

    //Hiding "display" div in "search.php" file.

    $('#display').hide();

}

$(document).ready(function() {
    $("#search").keyup(function() {      //On pressing a key on "Search box" in "search.php" file. This function will be called.
        var name = $('#search').val();
        if (name == "") {           //Validating, if "name" is empty.
            $("#searchbox").html("");              //Assigning empty value to "display" div in "search.php" file.
        }
        else {
            $.ajax({
                type: "POST",
                url: "/ajax",
                data: {
                    search: name
                },
                success: function(html) {                 //If result found, this funtion will be called.
                    $("#searchbox").html(html).show();                     //Assigning result to "display" div in "search.php" file.

                }
            });

        }

    });

});