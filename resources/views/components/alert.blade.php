@props(['on'])

<div x-data="{ shown: false, timeout: null }" x-init="@this.on('{{ $on }}', () => {
    clearTimeout(timeout);
    shown = true;
    timeout = setTimeout(() => { shown = false }, 2000);
})" x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms style="display: none;" {{ $attributes->merge(['class' => 'mx-3']) }}>
    <div class="alert alert-primary d-flex align-items-center alert-fixed" role="alert">
        <i class="bi bi-bell me-2"></i>
        <div>
            {{ $slot->isEmpty() ? 'Proses berhasil' : $slot }}
        </div>
    </div>
</div>

@push('styles')
    <style>
        .alert-fixed {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: auto;
        }
    </style>
@endpush
