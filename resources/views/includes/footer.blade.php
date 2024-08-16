
      </div>
    </div>



    <!-- jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @include('includes.alert')
    <script>
         $(document).ready(function() {
            $('#toggleSidebar').click(function() {
                $('.sidebar').toggleClass('collapsed');
                $('#mainContent').toggleClass('expanded');
            });
        });
    </script>



 </body>

</html>

