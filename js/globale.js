$(document).ready(function () {
    //Delete Produit  data
    $("tbody").on('click','#btn-delete-prod',function(){
        
        var id_prod=$(this).attr("data-id");
        MyData_del_prod={id_prod:id_prod};
        this_btn_prod=this;
        $.ajax({
            url:"delete.php",
            method:"POST",
            data:JSON.stringify(MyData_del_prod),
            success:function(data)
            {
                //console.log(data);
                $("#frm_price").submit();
                $(this_btn_prod).closest("tr").fadeOut("slow");
            }
        });
       
    });





    //$("#message").delay(1500).slideUp(500);
     


    $(window).load(function () {

        var rnd = 1500;

        $('.progress').css("animation", "loading " + rnd + "ms linear");

        setTimeout(function () {

            $('#loader').hide();
            $('#page').removeClass('hidden');

        }, rnd);

    });




    function hasClass(ele, cls) {
        return !!ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
    }

    function addClass(ele, cls) {
        if (!hasClass(ele, cls)) ele.className += " " + cls;
    }

    function removeClass(ele, cls) {
        if (hasClass(ele, cls)) {
            var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
            ele.className = ele.className.replace(reg, ' ');
        }
    }


    function init() {
        document.getElementById("open-menu").addEventListener("click", toggleMenu);
        document.getElementById("body-overlay").addEventListener("click", toggleMenu);
    }

    function toggleMenu() {
        var ele = document.getElementsByTagName('body')[0];
        if (!hasClass(ele, "menu-open")) {
            addClass(ele, "menu-open");
        } else {
            removeClass(ele, "menu-open");
        }
    }


    document.addEventListener('readystatechange', function () {
        if (document.readyState === "complete") {
            init();
        }
    });

    var swiper3 = new Swiper(".mySwiper3", {

        spaceBetween: 10,
        breakpoints: {
            320: { slidesPerView: 4, },
            640: {
                slidesPerView: 12,
            }
        }
    });


    var swiper = new Swiper(".mySwiper", {});



    const rangeInput = document.querySelectorAll(".range-input input"),
        priceInput = document.querySelectorAll(".price-input input"),
        range = document.querySelector(".slider .progress");
    let priceGap = 1000;
    priceInput.forEach(input => {
        input.addEventListener("input", e => {
            let minPrice = parseInt(priceInput[0].value),
                maxPrice = parseInt(priceInput[1].value);

            if ((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max) {
                if (e.target.className === "input-min") {
                    rangeInput[0].value = minPrice;
                    range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                } else {
                    rangeInput[1].value = maxPrice;
                    range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";      
                }
            }
        });
    });
    rangeInput.forEach(input => {
        input.addEventListener("input", e => {
            let minVal = parseInt(rangeInput[0].value),
                maxVal = parseInt(rangeInput[1].value);
            if ((maxVal - minVal) < priceGap) {
                if (e.target.className === "range-min") {
                    rangeInput[0].value = maxVal - priceGap
                } else {
                    rangeInput[1].value = minVal + priceGap;
                }
            } else {
                priceInput[0].value = minVal;
                priceInput[1].value = maxVal;
                range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
            }
        });
    });

    function changeIt(_src) {
        document.getElementById("pic1").src = _src;
    }


/**Slider range**/
(function ($) {
  
    $('#price-range-submit').hide();
  
      $("#min_price,#max_price").on('change', function () {
  
        $('#price-range-submit').show();
  
        var min_price_range = parseInt($("#min_price").val());
  
        var max_price_range = parseInt($("#max_price").val());
  
        if (min_price_range > max_price_range) {
          $('#max_price').val(min_price_range);
        }
  
        $("#slider-range").slider({
          values: [min_price_range, max_price_range]
        });
        
      });
  
  
      $("#min_price,#max_price").on("paste keyup", function () {                                        
  
        $('#price-range-submit').show();
  
        var min_price_range = parseInt($("#min_price").val());
  
        var max_price_range = parseInt($("#max_price").val());
        
        if(min_price_range == max_price_range){
  
              max_price_range = min_price_range + 10;
              
              $("#min_price").val(min_price_range);		
              $("#max_price").val(max_price_range);
        }
  
        $("#slider-range").slider({
          values: [min_price_range, max_price_range]
        });
  
      });
      
    //filter by price
    $(function () {
        $("#slider-range").slider({
            range: true,
            orientation: "horizontal",
            min: 0,
            max: 10000,
            values: [0, 10000],
            step: 10,
            slide: function (event, ui) {
            if (ui.values[0] == ui.values[1]) {
                return false;
            } 
            $("#min_price").val(ui.values[0]);
            $("#max_price").val(ui.values[1]);
            }
        });
        $("#min_price").val($("#slider-range").slider("values", 0));
        $("#max_price").val($("#slider-range").slider("values", 1));
        });

        $("#slider-range,#price-range-submit").click(function () {
            filter_data();
        });

    
  
    
  })(jQuery);

    function filter_data(){
        var action ="fetch_data";
        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();
        var category = get_filter('category');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            beforeSend: function() {
                $("#loading").removeClass("hidden");
            },
            data:{action:action,min_price:min_price,max_price:max_price,category:category},
            success:function(data){
                $(".searchresult").html(data);
            },complete: function() {
                $("#loading").addClass("hidden");
            },
        });
    }

    function get_filter(class_name){
        var filter=[];
        $("."+class_name+":checked").each(function(){
            filter.push($(this).val());
        });
        return filter;
    };
  
    $(".category").click(function(){
        filter_data();
    })

    //code add product to cart 

    $(".addItemBtn").click(function(e){
        e.preventDefault();
        var $form  = $(this).closest(".form-submit");
        var ip = $form.find(".id_p").val();
        var namep = $form.find(".name_p").val();
        var pricep = $form.find(".price_p").val();
        var imagep = $form.find(".image_p").val();
        var id_owner_product = $form.find(".id_owner_product").val();
        $.ajax({
            url:"action",
            method:"POST",
            data:{ip:ip,namep:namep,pricep:pricep,imagep:imagep,id_owner_product:id_owner_product},
            success:function (response) {
                location.reload(true);
                $("#message").html(response);
                //console.log(response);
                load_cart_item_number();
            }
        })
    });
    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number(){
        $.ajax({
            url:"action",
            method:"GET",
            data:{cartItem:"cart_item"},
            success: function(response) {
                $("#cart-item").html(response);
            }
        })
    }

    $(".iQuetity").on('change',function () {
        var $el = $(this).closest('tr');
        
      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".iQuetity").val();
      location.reload(true);
      $.ajax({
        url: 'action',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          //console.log(response);
        }
      });
    });
});

function changeIt(_src){
    document.getElementById("pic1").src=_src;
}





function fill(Value) {
   $('#search').val(Value);
   $('#display').hide();
}



$(document).ready(function() {
    
    
    
    
   $("#search").keyup(function() {

       var name = $('#search').val();
       if (name == "" ) {
           $("#display").html("");
       }
       else {
           $.ajax({
               type: "POST",
               url: "ajax.php",
               data: {
                   search: name
               },
               success: function(html) {
                   $("#display").html(html).show();
                   
               }
           });
       }
   });
   
   
});













