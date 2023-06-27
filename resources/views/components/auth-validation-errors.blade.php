@props(['errors'])

@if ($errors->any())
    <?php //\Log::warning($errors); ?>
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            Terjadi Kesalahan
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
