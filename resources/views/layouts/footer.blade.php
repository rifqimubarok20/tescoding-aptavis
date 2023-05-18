<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Info Klasemen 2023</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<script>
    function disableSelectedTeam(selectedValue, selectId) {
        var selectElement = document.getElementsByName(selectId)[0];
        var options = selectElement.options;

        for (var i = 0; i < options.length; i++) {
            if (options[i].value === selectedValue) {
                options[i].disabled = true;
            } else {
                options[i].disabled = false;
            }
        }
    }
</script>
