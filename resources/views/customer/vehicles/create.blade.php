<form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Vehicle Name</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Type</label>
        <select name="type" required>
            <option value="truck">Truck</option>
            <option value="crane">Crane</option>
        </select>
    </div>
    <div>
        <label>Registration Number</label>
        <input type="text" name="registration_number" required>
    </div>
    <div>
        <label>Images</label>
        <input type="file" name="images[]" multiple>
    </div>
    <button type="submit">Add Vehicle</button>
</form>