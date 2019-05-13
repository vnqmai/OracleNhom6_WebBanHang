$(document).ready(function(){		
	// id; hinh; ten; dongia; sl;
	// var obj = jQuery.parseJSON(sessionStorage.getItem("cart"));
	// alert(obj.ten);
	cart = sessionStorage.getItem('cart');	
	listitem = jQuery.parseJSON(cart);
	if(listitem==null)
		$('.shopping-card').find('span').text('0');
	else
		$('.shopping-card').find('span').text(listitem.length);
	$('.add-card').click(function(){		
		id = $(this).attr('value');
		hinh = $(this).parent().parent().find('img').attr('src');
		ten = $(this).parent().parent().parent().find('.pi-text').find('p').find('a').text();
		dongia = $(this).parent().parent().parent().find('.pi-text').find('h6').text();
		sl = 1;
		if(cart == null){
			sessionStorage.setItem("cart", '[{"id":'+id+', "hinh":"'+hinh+'", "ten": "'+ten+'", "dongia": '+dongia+', "soluong":1}]');			
		}
		else{			
			dem = 0;			
			for(var i = 0;i<listitem.length;++i){
				if(listitem[i].id==id){
					listitem[i].soluong += 1;
					++dem;
				}
			}
			if(dem==0){
				var newitem = jQuery.parseJSON('{"id":'+id+', "hinh":"'+hinh+'", "ten": "'+ten+'", "dongia": '+dongia+', "soluong":1}');				
				listitem.push(newitem);				
			}
			sessionStorage.setItem("cart", JSON.stringify(listitem));						
		};	

		//THÔNG BÁO THÀNH CÔNG		
		if(listitem==null)
			$('.shopping-card').find('span').text('0');
		else
			$('.shopping-card').find('span').text(listitem.length);	
		$( "#dialog-confirm" ).dialog({		
	      resizable: false,
	      height: "auto",
	      width: 400,
	      modal: true,
	      buttons: {
	        "Xem giỏ hàng": function() {
	          window.location.href = 'cart.php';
	        },
	        "Thanh toán": function() {
	          window.location.href = 'checkout.php';
	        },
	        "Đóng": function() {
	          $( this ).dialog( "close" );
	        }
	      }	      
	    });
	    $('#dialog-confirm').find('p').css('display','block');
	});		
});
