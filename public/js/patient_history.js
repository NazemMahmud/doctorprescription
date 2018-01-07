/**
 * Created by Nazem Mahmud on 12/26/2017.
 */
$(document).ready(function(){
//                  CREATE A SESSION FOR PATIENT
    $("#create_session").click(function(){
        $("#prescription").slideToggle("slow");
    })

    //DYNAMIC MEDICINE ADD STARTS
    var max_fields      = 20; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 0; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="more_medicine_row"><div class="row" style="margin-bottom: 5px;">' +
                '<div class="col-md-5 col-sm-5" style="margin-bottom: 5px;">'+
                '<input type="text" class="form-control" name="medicine['+x+'][name]" placeholder="Medicine name">' + '</div>'+
                '<div class="col-md-4 col-sm-4" style="margin-bottom: 5px;">'+
                '<input class="form-control" name="medicine['+x+'][duration]" type="number"  placeholder="Duration in days">'+ '</div>'+
                '</div>' +
                '<div class="row">'+
                '<div class="col-md-5 col-sm-5" style="margin-bottom: 5px;">'+
                '<select class="selectpicker form-control" id="" name="medicine['+x+'][dose]" type="text">'+
                '<option value="NULL">Select Dose</option>'+
                '<option value="1-0-1">1-0-1</option>'+
                '<option value="1-0-0">1-0-0</option>'+
                '<option value="1-1-1">1-1-1</option>'+
                '<option value="drop half hour delay">drop half hour delay</option>'+
                '<option value="drop 3 hour delay">drop 3 hour delay</option>'+
                '</select>'+
                '</div>'+
                '<div class="col-md-4 col-sm-4 " style="margin-bottom: 5px;">'+
                '<select class="form-control" id="" name="medicine['+x+'][before_after_meal]" type="text">'+
                '<option value="NULL">Before/After Meal</option>'+
                '<option value="before">before taking meal</option>'+
                '<option value="after">after taking meal</option>'+
                '</select>'+
                '</div>'+
                '<div class="col-md-1 col-sm-1 ">'+'<a href="#" class="btn btn-danger remove_field">Remove</a></div>' +
                '</div>'+
                '</div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove();
//                $(this).parent('div').remove(); more_medicine_row
        x--;
    })
    //DYNAMIC MEDICINE ADD END
    $( "#return_date" ).datepicker(); // this is datepicker b****

    $('.selectpicker').selectpicker();
});



    // $(document).ready(function() {
    //
    // });
