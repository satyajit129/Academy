<div class="basic-form">
    <div class="form-group">
        <label for="">Name Of the Exam</label>
        <input type="text" name="name" class="form-control"
            value="{{ old('name') }}" placeholder="Name of the Exam" required>
    </div>
</div>
<!-- Start Date and Time -->
<div class="basic-form">
    <div class="form-group">
        <label for="exam_type">Start Date & Time</label>
            <input type="text" name="start_datetime" class="form-control date-format" placeholder="Enter Start Date & Time">
    </div>
</div>
<!-- End Date and Time -->
<div class="basic-form">
    <div class="form-group">
        <label for="end_datetime">End Date & Time</label>
        <input type="text"  name="end_datetime" class="form-control date-format" placeholder="Enter End Date & Time" value="{{ old('end_datetime') }}" required>
    </div>
</div>

