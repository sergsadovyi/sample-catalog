(function($){
    // Add to cart buttons
    $('.add-to-cart').click(function(){
        var id = $(this).data('product');
        $.get(url('/cart/add/' + id), function(html){
            updateCart(html);
        });
    });

    // Remove from cart
    $('.remove').click(function(){
        var id = $(this).data('product');
        $.get(url('/cart/del/' + id), function(html){
            updateCart(html);
        });
    });

    // Update cart module
    var updateCart = function(html) {
        $('.shopping-cart').html(html);
    };

    // Combines url and symfony env path
    var url = function(path){
        var env = $('body').data('env');
        return env + path;
    };
})(jQuery);