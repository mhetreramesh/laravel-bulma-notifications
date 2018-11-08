@if (Session::has('alert.config'))
<script>
    var modalConfig = {!! Session::pull('alert.config') !!};
</script>
<div class="column is-3" style="position: fixed; bottom: 0; right: 0" id="bulma-notifications">
    <div class="notification is-primary" id="bulma-notification-box">
        <button class="delete" id="bulma-notify-close"></button>
        <h6 class="subtitle" id="bulma-notify-title"></h6>
        <p id="bulma-notify-content"></p>
    </div>
</div>
<script src="{{ asset('vendor/bulma-notifications/notifications.js') }}"></script>
<script>

</script>
@endif