$(document).ready(function() {
    function fetchCategories() {
        $.ajax({
            url: '../actions/view_category_action.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var categoryDropdown = $('#category-dropdown');
                var categoryList = $('#category-list');
                categoryDropdown.empty();
                categoryList.empty();
                $.each(data, function(index, category) {
                    categoryDropdown.append($('<option>', {
                        value: category.cat_id,
                        text: category.cat_name
                    }));
                    categoryList.append('<li class="list-group-item">' + category.cat_name + '</li>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching categories:', error);
            }
        });
    }

    fetchCategories();

    $('#categoryForm').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: '../actions/add_category_action.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire('Success', response.message, 'success');
                    fetchCategories();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error', 'An error occurred while adding the category', 'error');
            }
        });
    });

    $('#delete-category-button').click(function() {
        var categoryId = $('#category-dropdown').val();
        if (categoryId) {
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
                        url: '../actions/delete_category_action.php',
                        method: 'POST',
                        data: { cat_id: categoryId },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Deleted!', response.message, 'success');
                                fetchCategories();
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error', 'An error occurred while deleting the category', 'error');
                        }
                    });
                }
            });
        } else {
            Swal.fire('Please select a category to delete');
        }
    });
});