<script>
    window.Laravel = {!! json_encode([
    'locales' => [
        [
            'code' => 'en',
            'name' => 'English',
        ],
        [
            'code' => 'de',
            'name' => 'German',
        ],
    ],
    'translations' => $translations,
]) !!};
</script>
