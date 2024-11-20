$(document).ready(function() {
    let categories = {};
    let brands = {};

    function fetchCategories() {
        return $.ajax({
            url: '../actions/view_category_action.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                categories = data.reduce((acc, category) => {
                    acc[category.cat_id] = category.cat_name;
                    return acc;
                }, {});
                var categoryDropdown = $('#category-dropdown');
                categoryDropdown.empty();
                categoryDropdown.append('<option value="">All Categories</option>');
                $.each(data, function(index, category) {
                    categoryDropdown.append($('<option>', {
                        value: category.cat_id,
                        text: category.cat_name
                    }));
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching categories:', error);
            }
        });
    }

    function fetchBrands() {
        return $.ajax({
            url: '../actions/get_brand_action.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                brands = data.reduce((acc, brand) => {
                    acc[brand.brand_id] = brand.brand_name;
                    return acc;
                }, {});
            },
            error: function(xhr, status, error) {
                console.error('Error fetching brands:', error);
            }
        });
    }

    function fetchProducts(categoryId = '') {
        return $.ajax({
            url: '../actions/get_product_action.php',
            method: 'GET',
            data: { category_id: categoryId },
            dataType: 'json',
            success: function(data) {
                var productTableBody = $('#product-table-body');
                productTableBody.empty();
                $.each(data, function(index, product) {
                    productTableBody.append(`
                        <tr>
                            <td>${product.product_title}</td>
                            <td>${brands[product.product_brand]}</td>
                            <td>${categories[product.product_cat]}</td>
                            <td>${product.product_price}</td>
                            <td>${product.product_desc}</td>
                            <td><img src="${product.product_image}" alt="${product.product_title}" width="50"></td>
                            <td>${product.product_keywords}</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-product" data-id="${product.product_id}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                                <button class="btn btn-add-to-cart btn-sm add-to-cart" data-id="${product.product_id}">
                                    <i class="fas fa-cart-plus"></i> Add To Cart
                                </button>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching products:', error);
            }
        });
    }

    $.when(fetchCategories(), fetchBrands()).done(function() {
        fetchProducts();
    });

    $('#category-dropdown').change(function() {
        var selectedCategory = $(this).val();
        fetchProducts(selectedCategory);
    });

    $(document).on('click', '.delete-product', function() {
        var productId = $(this).data('id');
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
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Deleted!', response.message, 'success');
                            fetchProducts();
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', 'An error occurred while deleting the product/service', 'error');
                    }
                });
            }
        });
    });

    $(document).on('click', '.add-to-cart', function() {
        var productId = $(this).data('id');
        var quantity = 1; // Default quantity

        console.log('Add to Cart button clicked for product ID:', productId);

        if (!customerId) {
            Swal.fire('Error', 'You need to be logged in to add items to the cart', 'error');
            return;
        }

        $.ajax({
            url: '../actions/add_to_cart_action.php',
            method: 'POST',
            data: {
                product_id: productId,
                ip_address: ipAddress,
                customer_id: customerId,
                quantity: quantity
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire('Success', response.message, 'success');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.fire('Error', 'An error occurred while adding the product to the cart', 'error');
            }
        });
    });
});