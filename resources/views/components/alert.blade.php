@props(['type' => 'success', 'message' => ''])

@if($message)
    @php
        $style = $type === 'danger' 
            ? 'background-color: #18181b; color: #ffffff; border-left: 5px solid #71717a;' 
            : 'background-color: #e4e4e7; color: #18181b; border-left: 5px solid #18181b;';
    @endphp
    <div class="alert alert-dismissible fade show shadow-sm border-0 mb-4" style="{{ $style }}" role="alert">
        <strong class="me-1">{{ $type === 'danger' ? '[PERINGATAN]' : '[INFO]' }}</strong> {{ $message }}
        <button type="button" class="btn-close {{ $type === 'danger' ? 'btn-close-white' : '' }}" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif