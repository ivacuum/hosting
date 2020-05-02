@push('head')
@livewireStyles
@endpush

@push('js_vendor')
@livewireScripts
<script src="{{ mix('/assets/livewire-vue.js') }}"></script>
@endpush
