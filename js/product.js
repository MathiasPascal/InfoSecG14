$(document).ready(function () {
    // Fetch brands and populate the brand dropdown
    $.ajax({
        url: '../actions/get_brand_action.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            var brandDropdown = $('#brand');
            brandDropdown.empty();
            brandDropdown.append('<option value="">Select a brand</option>');
            $.each(data, function (index, brand) {
                brandDropdown.append($('<option>', {
                    value: brand.brand_id,
                    text: brand.brand_name
                }));
            });
        },
        error: function (xhr, status, error) {
            console.error('Error fetching brands:', error);
        }
    });

    // Fetch categories and populate the category dropdown
    $.ajax({
        url: '../actions/view_category_action.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            var categoryDropdown = $('#category');
            categoryDropdown.empty();
            categoryDropdown.append('<option value="">Select a category</option>');
            $.each(data, function (index, category) {
                categoryDropdown.append($('<option>', {
                    value: category.cat_id,
                    text: category.cat_name
                }));
            });
        },
        error: function (xhr, status, error) {
            console.error('Error fetching categories:', error);
        }
    });

    function fetchProducts() {
        $.ajax({
            url: '../actions/get_product_action.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                var productDropdown = $('#product-dropdown');
                productDropdown.empty();
                productDropdown.append('<option value="">Select a product/service</option>');
                $.each(data, function (index, product) {
                    productDropdown.append($('<option>', {
                        value: product.product_id,
                        text: product.product_title
                    }));
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching products:', error);
            }
        });
    }

    fetchProducts();

    // Handle add product form submission
    $('#productForm').submit(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: '../actions/addProduct.php',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire('Success', response.message, 'success');
                    fetchProducts();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'An error occurred while adding the product/service', 'error');
            }
        });
    });

    $('#delete-product-button').click(function () {
        var productId = $('#product-dropdown').val();
        if (productId) {
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
                        url: '../actions/delete_product_action.php',
                        method: 'POST',
                        data: { product_id: productId },
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                Swal.fire('Deleted!', response.message, 'success');
                                fetchProducts();
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function (xhr, status, error) {
                            Swal.fire('Error', 'An error occurred while deleting the product/service', 'error');
                        }
                    });
                }
            });
        } else {
            Swal.fire('Please select a product to delete');
        }
    });
});