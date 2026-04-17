
     <!--**********************************
        Main wrapper end
    ***********************************-->
    </div>
    </div>
    <script  src="{{ asset('adminPanal/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <Script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('fa417b250f1aa7187006', {
            cluster: 'eu'

         var channel = pusher.subscribe('new-category');
         channel.bind('category.approved', function(data) {
         alert(JSON.stringify(data));
    });
        });
    </Script>
    <script  src="{{ asset('adminPanal/js/bootstrap.bundle.min.js') }}"></script>
    <script  src="{{ asset('adminPanal/js/chart.js') }}"></script>
    <script  src="{{ asset('adminPanal/js/main.js') }}"></script>
</body>
</html>
