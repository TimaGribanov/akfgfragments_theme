<script type="text/javascript">
    function getTimeZone() {
        return Intl.DateTimeFormat().resolvedOptions().timeZone
    }
    let timezone = getTimeZone()
    document.cookie = `local_timezone=${timezone};SameSite=Lax`
</script>