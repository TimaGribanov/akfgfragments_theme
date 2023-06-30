<script type="text/javascript">
    function getTimeZone() {
        return Intl.DateTimeFormat().resolvedOptions().timeZone
    }

    let timezone = getTimeZone()
    document.cookie = `local_timezone=${timezone};SameSite=Lax`

    if (sessionStorage.getItem('reloaded') === false || sessionStorage.getItem('reloaded') === null) {
        location.reload()
        sessionStorage.setItem('reloaded', true)
    }
</script>