<script type="text/javascript">
    var iv_{{$id}} = null;
    var viewer_{{$id}} = null;

    function initMap_{{$id}}() {
        viewer_{{$id}} = iv_{{$id}}.getViewer();

        @if (!empty($overlays))
            @foreach($overlays as $overlay)
                {{$overlay}}
            @endforeach
        @endif
    }

    window.onload=function() {
        iv_{{$id}} = Geoportal.load(
            '{{$id}}',
            ['{{$key}}'],
            { {{$center}} },
            {{$zoom}},
            {
                onView: initMap_{{$id}},
                {{$options}}
            }
        );
    }

</script>