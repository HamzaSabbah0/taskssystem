<footer class="main-footer">
    <strong>Copyright &copy; {{ now()->year }} - {{ now()->year + 1 }} <a
            href="#">{{ env('APP_NAME') }}</a></strong>
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> {{ env('APP_VERSION') }}
    </div>
</footer>
