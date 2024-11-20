$(document).ready(function() {
    $.ajax({
        url: '../actions/get_brand_action.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var dropdown = $('#brand-dropdown');
            var brandList = $('#brand-list');
            dropdown.empty(); 
            brandList.empty();  
            dropdown.append('<option value="">Select a brand</option>');
            $.each(data, function(index, brand) {
                dropdown.append($('<option>', {
                    value: brand.brand_id,
                    text: brand.brand_name
                }));
                brandList.append(`
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        ${brand.brand_name}
                        <button class="btn btn-danger btn-sm delete-brand" data-id="${brand.brand_id}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </li>
                `);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching brands:', error);
        }
    });


    $('#delete-brand-button').click(function() {
        var brandId = $('#brand-dropdown').val();
        if (brandId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../actions/delete_brand_action.php',
                        method: 'POST',
                        data: { brand_id: brandId },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Brand has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error deleting brand:', error);
                        }
                    });
                }
            });
        } else {
            Swal.fire('Please select a brand to delete');
        }
    });
    $(document).on('click', '.delete-brand', function() {
        var brandId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../actions/delete_brand_action.php',
                    method: 'POST',
                    data: { brand_id: brandId },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Brand has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting brand:', error);
                    }
                });
            }
        });
    });
});