<div x-data='{ open:false }' @flash-message.windows="open = true; setTimeout(()=>open=false,4000);">
    <div x-show="open" x-cloak class="border {{ $type ? $colors[$type] : '' }} px-1 py-2 rounded">
        {{ $message }}
    </div>
</div>
