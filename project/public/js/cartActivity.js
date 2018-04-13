(function ($) {
  $(function () {

    totalSum();

    changeCount();

    deleteItem();

    saveCart();

    itemCost();

    clearCart();

    //при загрузке из корзины вычисялет произведение количества и цены каждого товара
    function itemCost() {
      $('.order_item').each(function (i, el) {
        if ($(el).find('span[data-type="count"]').length > 0) {
          var count = $(el).find('span[data-type="count"]').text();
          var price = $(el).find('span[data-type="price"]').text();
          $(el).find('.count_item').val(count);
          $(el).find('.cart_item_sum').text(count * price);
        }
      });
      totalSum();
    }

    //calculating total sum
    function totalSum() {
      var sum = 0;
      $('.cart_item_sum').each(function (i, el) {
        sum += parseInt($(el).text());
      });
      $('.cart_total_sum').text(sum);
    }

    //при изменении количества товара подсчитывем общую сумму
    function changeCount() {
      $('.count_item').on('change', function () {
        var cost = parseInt($(this).parent().prev().find('span[data-type="price"]').text());
        var count = parseInt($(this).val());
        $(this).parent().next().children('.cart_item_sum').text(count * cost);
        totalSum();
      });
    }

    //deleting item from cart
    function deleteItem() {
      $('.delete_item').click(function () {
        var id = $(this).data('id');
        var itemBlock = $(this).closest('.order_item');
        var message = '';
        $.ajax({
          url: '/project/public/cart/deleteItem',
          type: 'POST',
          data: {
            id: id
          },
          success: function (responce) {
            message = responce;
          }
        }).done(function () {
          if (message = 'ok') {
            itemBlock.remove();
            totalSum();
          }
        })
      });
    }

    //save cart to bd
    function saveCart() {
      $('.save_cart').click(function () {
        var orderArr = [];
        //получаем из корзины ID и количество для каждого товара и передаем ПОСТом
        $('.order_item').each(function (i, el) {
          var id = $(el).find('span[data-type="id"]').text();
          var count = $(el).find('.count_item').val();
          orderArr.push({id: id, count: count});
        });
        $.post({
          url: '/project/public/cart/saveCart',
          // dataType: 'json',
          data: {
            order: orderArr
          },
          success: function (responce) {
            alert(responce);
          }
        })
      });
    }

    function clearCart() {
      $('.clear_cart').click(function () {
        $.post({
          url: '/project/public/cart/clearCart',
          // dataType: 'json',
          data: {
            cart: 'clear'
          },
          success: function (responce) {
            alert(responce);
          }
        }).done(function () {
          $('.cart_orders').remove();
        })
      });
    }

  })
})(jQuery);