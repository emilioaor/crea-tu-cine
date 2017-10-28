<style>
    @if(isset($styles) && count($styles))

        @foreach($styles as $style)
            {{ $style->selector . ' { ' . $style->property . ' : ' . $style->value . '!important' . ' }' }}
        @endforeach
    @endif
</style>