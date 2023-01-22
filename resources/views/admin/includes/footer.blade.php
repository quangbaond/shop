<!-- Footer Start -->
<footer class="footer text-center text-sm-start">
    &copy; <script>
        document.write(new Date().getFullYear())
    </script> {{ env('APP_NAME') }} <span class="text-muted d-none d-sm-inline-block float-end">Crafted with <i
            class="mdi mdi-heart text-danger"></i> by <a href="{{ env('APP_COPY_RIGHT_LINK') }}">{{ env('APP_COPY_RIGHT') ?? 'Nguyễn Quang Bảo'  }}</a></span>
</footer>
<!-- end Footer -->
