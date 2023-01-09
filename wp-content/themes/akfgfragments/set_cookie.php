<script type="text/javascript">
    function getTimeZone() {
        return Intl.DateTimeFormat().resolvedOptions().timeZone
    }
    
    let timezone = getTimeZone()
    document.cookie = `local_timezone=${timezone};SameSite=Lax`

    if (localStorage.getItem('reloaded') === false || localStorage.getItem('reloaded') === null) {
        location.reload()
        localStorage.setItem('reloaded', true)
    }
</script>