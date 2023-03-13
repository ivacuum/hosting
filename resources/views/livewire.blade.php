@once
@push('head')
@livewireStyles
@endpush

@push('js_vendor')
@livewireScripts
@vite('node_modules/livewire-vue/dist/livewire-vue.js')
@endpush
@endonce
