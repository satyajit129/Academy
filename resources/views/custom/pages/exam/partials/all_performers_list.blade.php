@foreach ($all_performers as $all_performer)
    <div class="performer-row">
        <div class="performer-cell">{{ $loop->iteration + ($all_performers->currentPage() - 1) * $all_performers->perPage() }}</div>
        <div class="performer-cell">{{ $all_performer->userInfo->name }}</div>
        <div class="performer-cell">{{ $all_performer->total_answered }}</div>
        <div class="performer-cell">{{ $all_performer->total_correct }}</div>
        <div class="performer-cell">{{ $all_performer->total_wrong }}</div>
        <div class="performer-cell">{{ $all_performer->total_marks }}</div>
    </div>
@endforeach

<div class="p-2">
    {{ $all_performers->links() }}
</div>

