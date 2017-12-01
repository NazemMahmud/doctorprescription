<div  id="doctors_name" style="z-index:999;">
    <ul style="list-style-type: none; margin: 0; padding: 0; border: 1px solid #ccc;border-bottom: none;">
        @foreach($name as $doctor)
            <li style="padding: 5px; border-bottom: 1px solid #ccc;" onclick='fill("{{ $doctor->name }}")'>{{ $doctor->name }}</li>
        @endforeach

    </ul>
</div>
<script>
    function fill(Value) {
        $('#which_doc').val(Value);         //Assigning value to "search" div in "search.php" file.
        $('#doctors_name').hide(); //Hiding "display" div in "search.php" file.

    }
</script>
