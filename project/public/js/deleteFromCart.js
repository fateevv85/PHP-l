(function ($) {
  $(function () {

    //deleting item from cart
    $('.delete_item').click(function () {
      var id = $(this).data('id');
      alert(id);

      /*$.ajax({
        url: '/project/public/cart/deleteItem',
        type: 'POST',
        data: {
          id: id
        },
        dataType: 'json',
        success: function (responce) {
          console.log(responce);
        }
      })*/
    });

    //calculating total sum
    function totalSum() {
      var arr = $('.cart_item_sum');
      var sum = 0;
      for (var i = 0; i < arr.length; i++) {
        sum += parseInt(arr[i].textContent);
      }
      $('.cart_total_sum').text(sum);
    }

    totalSum();

    $('.count_item').on('change', function () {
      var cost = parseInt($(this).parent().prev().children('ul :nth-child(3)').children('span').text());
      var count = parseInt($(this).val());
      $(this).parent().next().children('.cart_item_sum').text(count * cost);

      totalSum();

    })
  })
})(jQuery);