
      </div>
    </div>



    <!-- jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if(Session::has('success'))
        <script>
           toastr.success("{{ Session::get('success') }}");
        </script>
    @endif

    @if(Session::has('info'))
        <script>
            toastr.info("{{ Session::get('info') }}");
        </script>
    @endif

    @if(Session::has('warning'))
      <script>
        toastr.warning("{{ Session::get('warning') }}");
      </script>
    @endif

    @if(Session::has('error'))
        <script>
           toastr.error("{{ Session::get('error') }}");
        </script>
    @endif
 </body>

</html>

