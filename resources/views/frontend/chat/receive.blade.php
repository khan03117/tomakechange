<div
    class="message
        @if ($recever_id == auth()->user()->id) receivebox  @endif
        @if ($chatroomId == auth()->user()->id) senderbox  @endif
         messagebody position-relative">
    @if ($message)
        {{ $message }}
    @endif
    @if ($file)
        <div class="w-100 d-flex justify-content-end">
            <button type="button" class="btn btn-sm btn-light rounded-end-0">{{ $file_name }}</button>
            <a download="" href="{{ $file }}" type="button"
                class="btn btn-sm btn-light dropdown-toggle rounded-start-0 dropdown-toggle-split">
                <span class="visually-hidden">Toggle Dropdown</span>
            </a>
        </div>
    @endif


    <p class="position-absolute bottom-0 @if ($chatroomId == auth()->user()->id) start-0 @endif top-100 text-nowrap">
        {{ $created_at }}</p>
</div>
