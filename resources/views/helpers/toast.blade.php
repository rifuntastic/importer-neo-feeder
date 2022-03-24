@if (session('success'))
<script>
    $.toast({
        hideAfter: 5000,
        allowToastClose: false,
        text: '{{ session('success') }}',
        showHideTransition: 'slide',
        icon: 'success',
        loaderBg: '#a3a4a5',
        bgColor: '#57b657',
        textColor: '#fff',
        position: 'top-right',
    })
</script>
@endif

@if (session('error'))
<script>
    $.toast({
        hideAfter: 5000,
        allowToastClose: false,
        text: '{{ session('error') }}',
        showHideTransition: 'slide',
        icon: 'error',
        loaderBg: '#a3a4a5',
        bgColor: '#ff4747',
        textColor: '#fff',
        position: 'top-right',
    })
</script>
@endif
