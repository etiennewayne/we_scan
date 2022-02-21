
        <script src="../includes/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>
        <script src="../includes/datatable/datatables.min.js"></script>


        <script>
            $(function(){
                $(".dropdown").hover(function(){
                    var dropdownMenu = $(this).children(".dropdown-menu");
                    if(dropdownMenu.is(":visible")){
                        dropdownMenu.parent().toggleClass("open");
                    }
                });
            });
        </script>


    </body>
</html>