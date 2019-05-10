$(document).ready(function(){	
	// id; hinh; ten; dongia; sl;
	// var obj = jQuery.parseJSON(sessionStorage.getItem("cart"));
	// alert(obj.ten);
	cart = sessionStorage.getItem('cart');	
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
			listitem = jQuery.parseJSON(cart);
			dem = 0;
			alert('số lượng item '+listitem.length);
			for(var i = 0;i<listitem.length;++i){
				if(listitem[i].id==id){
					listitem[i].soluong += 1;
					++dem;
				}
			}
			if(dem==0){
				var newitem = jQuery.parseJSON('{"id":'+id+', "hinh":"'+hinh+'", "ten": "'+ten+'", "dongia": '+dongia+', "soluong":1}');
				alert("new item: "+newitem.ten);
				listitem.push(newitem);				
			}
			sessionStorage.setItem("cart", JSON.stringify(listitem));
		}

		// item = jQuery.parseJSON('{"id":'+id+', "hinh":"'+hinh+'", "ten": "'+ten+'", "dongia": '+dongia+', "soluong":1}');							
	});
});