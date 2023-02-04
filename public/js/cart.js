
        $(document).ready(function(){
            //when + button click
            $('.btn-plus').click(function(){
               $parentNode = $(this).parents("tr");
               $price = Number($parentNode.find('#price').text().replace("kyats",""));
               $qty = Number($parentNode.find('#qty').val());
               $total = $price*$qty;
                $parentNode.find('#total').html($total+" kyats");

               summaryCalculation();

            })
            //when - button click
            $('.btn-minus').click(function(){
               $parentNode = $(this).parents("tr");
               $price = Number($parentNode.find('#price').text().replace("kyats",""));
               $qty = Number($parentNode.find('#qty').val());
            //    if($qty == 0){
            //     $('.btn-minus').attr('disabled');
            //    }
               $total = $price*$qty;
                $parentNode.find('#total').html($total+" kyats");

                summaryCalculation();

            })
            
            //calculate total
            function summaryCalculation(){
                $totalPrice = 0;
               $('#dataTable tbody tr').each(function(index,row){
                    $totalPrice += Number($(row).find('#total').text().replace("kyats",""));

               })
                $('#subTotalPrice').html(`${$totalPrice} kyats`);
                $('#finalTotalPrice').html(`${$totalPrice+3000} kyats`);
            }
        })

