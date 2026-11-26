@props([
    'name',
    'label',
    'placeholder' => '',
    'value' => '',
    'id' => $name,
    'required' => false,
    'rows' => 4,
    'rte' => false,
])


<div class="space-y-1">
    <label for="{{ $id }}" class="block font-mono text-[10px] font-bold uppercase tracking-[0.16em] text-blue-950/60">{{ $label }}@if($required)<span class="ml-1" aria-hidden="true">*</span>@endif </label>
    <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" class="editor block w-full border-2 border-blue-950/30 bg-white px-4 py-3 text-sm text-blue-950 outline-none transition focus:border-blue-600 focus:ring-0 {{ $errors->has($name) ? 'border-red-500' : 'border-blue-950/30' }}" placeholder="{{ $placeholder }}" @required($required)>{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

@if($rte)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/tinymce.min.js" integrity="sha512-RnlQJaTEHoOCt5dUTV0Oi0vOBMI9PjCU7m+VHoJ4xmhuUNcwnB5Iox1es+skLril1C3gHTLbeRepHs1RpSCLoQ==" crossorigin="anonymous"></script>

    <script>
        var editor_config = {
            relative_urls : false,
            path_absolute: "{{config('app.url')}}",
            selector: '.editor',
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks fullscreen',
                'contextmenu paste help wordcount code'
            ],
            toolbar: ' undo redo |  bold italic | link | alignleft aligncenter alignright alignjustify | numlist bullist | outdent indent | removeformat | code | help',
        }
        tinymce.init(editor_config);
    </script>
@endif

