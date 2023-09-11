<script>
    // Patient Date Picker Initialization
    $("#patient_dob_datepicker").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"), 10)
    });
</script>