<script type="text/javascript">
    var iv = null;
    var viewer = null;

    function initMap() {
        viewer = iv.getViewer();

        @if (!empty($overlays))
            @foreach($overlays as $overlay)
                {{$overlay}}
            @endforeach
        @endif
    }

    window.onload=function() {
        iv = Geoportal.load(
            '{{$id}}',
            ['{{$key}}'],
            { {{$center}} },
            {{$zoom}},
            {
                onView: initMap,
                {{$options}}
            }
        );
    }

</script>