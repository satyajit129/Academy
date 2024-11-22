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
        <label for="">Exam Duration</label>
            <input type="number" name="exam_duration" class="form-control" placeholder="Enter Exam Duration">
    </div>
</div>

<div class="basic-form">
    <div class="form-group">
        <label for="">Negative Marks</label>
        <select name="negative_marks" class="form-control">
            <option value="0">0</option>
            <option value="0.25">O.25</option>
            <option value="0.50" selected>0.50</option>
            <option value="1">1</option>
        </select>
    </div>
</div>
