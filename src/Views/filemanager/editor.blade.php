<!DOCTYPE html>
<?php $locale="en";?>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>elFinder 2.0</title>

    <!-- jQuery and jQuery UI (REQUIRED) -->
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/theme.css') }}">

    <!-- elFinder JS (REQUIRED) -->
    <script src="{{ asset($dir.'/js/elfinder.min.js') }}"></script>

@if($locale)
    <!-- elFinder translation (OPTIONAL) -->
        <script src="{{ asset($dir."/js/i18n/elfinder.$locale.js") }}"></script>
@endif

<!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript" charset="utf-8">
        // Helper function to get parameters from the query string.
        function getUrlParam(paramName) {
            var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
            var match = window.location.search.match(reParam) ;

            return (match && match.length > 1) ? match[1] : '' ;
        }

        $().ready(function() {
            var funcNum = getUrlParam('CKEditorFuncNum');

            var elf = $('#elfinder').elfinder({
                // set your elFinder options here
                @if($locale)
                lang: '{{ $locale }}', // locale
                @endif
                customData: {
                    _token: '{{ csrf_token() }}'
                },
                url: '<?php echo url('/file-manager/connector');?>',  // connector URL
                soundPath: '{{ asset($dir.'/sounds') }}',
                getFileCallback : function(file) {
                    // window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);
                    // window.close();
                    let __url = "{{url('')}}"
                    let str = file.url.replace(__url, '');
                    str = str.split('&')
                    str = str[str.length-1]
                    str = str.split('_')

                    console.log(str);
                    let path = "{{$s3url}}"+ atob(str[str.length-1]);
                    window.opener.CKEDITOR.tools.callFunction(funcNum, path);
                    window.close();
                }
            }).elfinder('instance');
        });
    </script>
    <style>
        #elfinder{
            height: calc(100vh - 20px) !important;
        }
        /* .elfinder-workzone{
            height: calc(100% - 70px);
        }
        .elfinder-navbar {
            height: 100% !important;
        } */
    </style>
</head>
<body>

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

</body>
</html>
