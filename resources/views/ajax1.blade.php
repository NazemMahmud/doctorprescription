<div  id="doctors_name">
    <ul style="list-style-type: none; margin: 0; padding: 0; border: 1px solid #ccc;border-bottom: none;">
        @foreach($name as $doctor)
            <li style="padding: 5px; border-bottom: 1px solid #ccc;">{{ $doctor->name }}</li>
        @endforeach

    </ul>
</div>
